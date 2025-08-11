module.exports = {
  important: '.acop',
  darkMode: ["class"],
  content: ["./*.php","./**/*.php","./**/*.js","./**/*.jsx", "./**/*.tsx"],
  theme: {
    container: {
      center: true,
      padding: "2rem",
      screens: {
        "2xl": "1400px",
      },
    },
    extend: {
      colors: {
        border: "hsl(var(--border))",
        input: "hsl(var(--input))",
        ring: "hsl(var(--ring))",
        background: "hsl(var(--background))",
        foreground: "hsl(var(--foreground))",
        primary: {
          DEFAULT: "#5B2C8A",
          foreground: "hsl(var(--primary-foreground))",
        },
        secondary: {
          DEFAULT: "#0099CC",
          foreground: "hsl(var(--secondary-foreground))",
        },
        accent: {
          DEFAULT: "#97C93D",
          foreground: "hsl(var(--accent-foreground))",
        },
        destructive: {
          DEFAULT: "hsl(var(--destructive))",
          foreground: "hsl(var(--destructive-foreground))",
        },
        muted: {
          DEFAULT: "hsl(var(--muted))",
          foreground: "hsl(var(--muted-foreground))",
        },
        popover: {
          DEFAULT: "hsl(var(--popover))",
          foreground: "hsl(var(--popover-foreground))",
        },
        card: {
          DEFAULT: "hsl(var(--card))",
          foreground: "hsl(var(--card-foreground))",
        },
        backgroundImage: {
          "button-blue": "linear-gradient(to right, #00A7E1, #0099CC)",
          "button-green": "linear-gradient(to right, #97C93D, #8AB82E)",
        },
      },
    },
  },
  plugins: [],
}