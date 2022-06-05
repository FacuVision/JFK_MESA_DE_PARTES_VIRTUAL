<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">


        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body
    x-data="alertComponent()"
  x-init="$watch('openAlertBox', value => {
    if(value){
      setTimeout(function () {
        openAlertBox = false
      }, 2000)
    }
  })"

    class="font-sans antialiased relative">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                        <!-- ALERTAS-->
                        <!-- <x:notify-messages /> -->
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <!-- notify -->
        <!-- @notifyJs -->
        <script>
            window.alertComponent = function () {
  return {
    openAlertBox: false,
    alertBackgroundColor: '',
    alertMessage: '',
    showAlert(type) {
      this.openAlertBox = true
      switch (type) {
        case 'success':
          this.alertBackgroundColor = 'bg-green-500'
          this.alertMessage = `${this.successIcon} ${this.defaultSuccessMessage}`
          break
        case 'info':
          this.alertBackgroundColor = 'bg-blue-500'
          this.alertMessage = `${this.infoIcon} ${this.defaultInfoMessage}`
          break
        case 'warning':
          this.alertBackgroundColor = 'bg-yellow-500'
          this.alertMessage = `${this.warningIcon} ${this.defaultWarningMessage}`
          break
        case 'danger':
          this.alertBackgroundColor = 'bg-red-500'
          this.alertMessage = `${this.dangerIcon} ${this.defaultDangerMessage}`
          break
      }
      this.openAlertBox = true
    },
    successIcon: `<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
    infoIcon: `<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
    warningIcon: `<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
    dangerIcon: `<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>`,
    defaultInfoMessage: `This alert contains info message.`,
    defaultSuccessMessage: `This alert contains success message.`,
    defaultWarningMessage: `This alert contains warning message.`,
    defaultDangerMessage: `This alert contains danger message.`,
  }
}
        </script>
    </body>
</html>
