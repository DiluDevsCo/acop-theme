<?php 
if (is_user_logged_in()) {
  $current_user = wp_get_current_user(); 
?>
<!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->

<header aria-label="Page Header" class="bg-gray-50">
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex items-center sm:justify-between sm:gap-4">
      <div class="relative hidden sm:block">
        <label class="sr-only" for="search"> Search </label>

        <input class="h-10 w-full rounded-lg border-none bg-white pe-10 px-4 text-sm shadow-sm sm:w-56" id="search"
          type="search" placeholder="Search website..." />

        <button type="button"
          class="absolute right-1 top-1/2 -translate-y-1/2 rounded-md bg-gray-50 p-2 text-gray-600 transition hover:text-gray-700">
          <span class="sr-only">Search</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </button>
      </div>
    </div>

    <div class="mt-8">
      <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
        Hola, <?php echo $current_user->user_firstname;?>!
      </h1>
    </div>
  </div>
</header>
<?php }?>