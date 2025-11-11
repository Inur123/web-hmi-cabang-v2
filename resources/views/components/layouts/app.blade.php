<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Dashboard - HMI Cabang Ponorogo' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-web.png') }}?v={{ time() }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo-web.png') }}?v={{ time() }}" />

    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- TinyMCE CDN -->
    <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin">
    </script>

    @livewireStyles

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: window.innerWidth >= 1024 }" x-cloak>
    <livewire:components.flash-message />

    <x-admin.sidebar />
    <x-admin.mobile-sidebar />

    <div :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'" class="transition-all duration-300">
        <x-admin.header />
        <main class="pt-20 md:pt-24 p-4 md:p-6 pb-20 md:pb-24">
            {{ $slot }}
        </main>
        <x-admin.footer />
    </div>

    @livewireScripts(['navigate'])

    <script>
        // Alpine.js TinyMCE Component - Global Setup
        document.addEventListener('alpine:init', () => {
            Alpine.data('tinyMCEComponent', (content) => ({
                content: content,
                editor: null,

                initEditor(selector) {
                    let component = this;

                    // Destroy existing editor if any
                    if (tinymce.get(selector)) {
                        tinymce.get(selector).remove();
                    }

                    tinymce.init({
                        selector: '#' + selector,
                        height: 400,
                        menubar: true,
                        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help emoticons',
                        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print | insertfile image media link anchor codesample | ltr rtl',
                        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px }',

                        setup: function(editor) {
                            component.editor = editor;

                            // Set initial content
                            editor.on('init', function() {
                                editor.setContent(component.content || '');
                            });

                            // Sync changes to Livewire
                            editor.on('change keyup paste', function() {
                                component.content = editor.getContent();
                            });
                        }
                    });
                },

                destroy() {
                    if (this.editor) {
                        tinymce.remove(this.editor);
                    }
                }
            }));
        });

        // Cleanup on Livewire navigation
        document.addEventListener('livewire:navigating', () => {
            tinymce.remove();
        });
    </script>
</body>

</html>
