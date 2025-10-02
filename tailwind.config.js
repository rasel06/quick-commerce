// tailwind.config.js
import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            spacing: {
                // Redefine default spacing scale
                '0': '0px',
                '1': '0.25rem',
                '2': '0.5rem',
                '3': '0.75rem',
                '4': '1rem',
                '5': '1.25rem',
                '6': '1.5rem',
                // etc.
            },
            padding: {
                card: '1rem',
                modal: '1.5rem',
            },
            margin: {
                row: '0.5rem',
            }
        }
    }
}
