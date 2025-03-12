const { exec } = require("child_process");
const path = require("path");
const chokidar = require('chokidar');
const anymatch = require('anymatch');
const fs = require('fs');
const postcss = require('postcss');
const cssnano = require('cssnano');
const autoprefixer = require('autoprefixer');
const matchers = [/(^|[\/\\])\../ ] ;
const compiledDir = `.${path.sep}assets`;
  
// Get command line arguments
const args = process.argv;

// Remove the compiled directory to ensure deleted files are removed
fs.rmSync(compiledDir, { recursive: true, force: true });

// Function executed when running on dev mode or when the --prod arg is not passed
// This code watches the files in src and blocks directories and copiles any css and javascript in them
const startWatcher = () => {
  const watcher = chokidar.watch([`.${path.sep}src`,`.${path.sep}blocks`], {
    ignored: (filePath) => {
      return anymatch(matchers,filePath);
    }, persistent: true
  });
  
  const log = console.log.bind(console);
  
  watcher
    .on('add', function(filePath) { 
      log('File', filePath, 'has been added'); 
      if (filePath.includes('css')) {
        minifyCSS();
      } else {
        checkFile(filePath);
      }
    })
    .on('addDir', function(filePath) { 
      // log('Directory', filePath, 'has been added'); 
    })
    .on('change', function(filePath) { {
      log('File', filePath, 'has been changed');
      if (filePath.includes('css')) {
        minifyCSS();
      } else {
        checkFile(filePath);
      }
    } })
    .on('unlink', function(filePath) { 
      log('File', filePath, 'has been removed'); 
      checkFile(filePath);
    })
    .on('unlinkDir', function(filePath) { 
      log('Directory', filePath, 'has been removed'); 
    })
    .on('error', function(error) { log('Error happened', error); })
    .on('ready', function() { 
      log('Initial scan complete. Ready for changes.');     
    })
    .on('raw', function(event, filePath, details) { 
      // log('Raw event info:', event, filePath, details); 
    });  
}

const getDirectoryFiles = (dir) => {
  let results = [];
  const list = fs.readdirSync(dir);
  list.forEach(function(file) {
      let toAdd = true;
      if (file[0] === '_') {
        toAdd = false;
      }
      file = dir + `${path.sep}` + file;
      const stat = fs.statSync(file);
      if (stat && stat.isDirectory()) { 
          /* Recurse into a subdirectory */
          results = results.concat(getDirectoryFiles(file));
      } else { 
          /* Is a file */
          if (toAdd) {
            results.push(file);
          }
      }
  });
  return results;
}

// Validates if the file is a javascript file and if so, it compiles it. Otherwise triggers the callback
const checkFile = (filePath, callback = () => {}) => {
  const ext = path.extname(filePath);
  const name = path.basename(filePath, ext);
  const dir = path.dirname(filePath);
  console.log(dir,ext);
  if ((ext === '.js' || ext === '.jsx' || ext === '.tsx')) {
    console.log('render');
    renderJS(`${name}${ext}`, dir, name, callback);
  } else {
    callback();
  }
}

// This code creates the js files in the assets directory
const renderJS = (file, dir, name, callback) => {
  let fileName = file;
  let theFile = '';
  console.log(dir, file);
  if (dir.includes('blocks')) {
    const dirParts = dir.split(path.sep);
    dir = `${dirParts[0]}${path.sep}${dirParts[1]}${path.sep}${dirParts[2]}${path.sep}${dirParts[3]}`;
    if (dirParts[0] === '.') {
      dir = `${dir}${path.sep}${dirParts[4]}`;
    }
    fileName = 'index.js';
  } else if (name[0] === '_'){
    const dirParts = dir.split(path.sep);
    dir = `${dirParts[0]}${path.sep}${dirParts[1]}`;
    fileName = 'sculapp.js';
    console.log(`Rendering ${dir}${path.sep}${fileName}`)
  }

  theFile = `${dir}${path.sep}${fileName}`;
  try {
    if (fs.existsSync(theFile)) {
      // Compiles the file. If in --prod mode, the file is minified
      exec(`npx esbuild ${theFile} --target=esnext --bundle --outdir=${compiledDir}${path.sep}${dir.replace(`src${path.sep}js`,'')} ${args.includes('--prod') ? '--minify': ''}`, (error, stdout, stderr) => {
        if (error) {
            console.log(`error: ${error.message}`);
            callback();
            return;
        }
        if (stderr) {
            console.log(`${stderr}`);
            callback();
            return;
        }
        console.log(`stdout: ${stdout}`);
        callback();
      });
    } else {
      console.error('File does not exist', theFile);
      callback();
    }
  } catch(err) {
    console.error(err);
    callback();
  }  
}

process.on('SIGINT', function() {
  console.log("Caught interrupt signal");
  process.exit();
});

// Function to compile all files in the src and blocks directories
const buildFiles = async () => {
  const files = [...getDirectoryFiles(`.${path.sep}src`),...getDirectoryFiles(`.${path.sep}blocks`).filter((file) => file.includes('index.js'))];
  let completedFiles = 0;
  for (const file of files) {
    checkFile(file, () => {
      completedFiles += 1;
      if (completedFiles === files.length) {
        console.log('All javascript files compiled');
      }
    });
  }
}

const minifyCSS = async () => {
  const files = [...getDirectoryFiles(`.${path.sep}blocks`).filter((file) => file.includes('.css'))];
  for (const file of files) {
    const css = fs.readFileSync(file, 'utf8');
    if (!fs.existsSync(file.replace(`.${path.sep}blocks`,`.${path.sep}assets${path.sep}blocks`))) {
      fs.mkdirSync(path.dirname(file.replace(`.${path.sep}blocks`,`.${path.sep}assets${path.sep}blocks`).replace(`${path.sep}src${path.sep}css`,'')), { recursive: true });
    }
    const output = await postcss([cssnano, autoprefixer])
      .process(css,{from: file});
    fs.writeFileSync(file.replace(`.${path.sep}blocks`,`.${path.sep}assets${path.sep}blocks`).replace(`${path.sep}src${path.sep}css`,''), output.css);
  }
}

(async() => {
  if (args.includes('--prod')) {
    await buildFiles();
    await minifyCSS();
  } else {
    startWatcher();
  }
})()
