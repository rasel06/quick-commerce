import preset from './vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            borderRadius: {
                'md': 'none',
                'lg': 'none',
                'xl': 'none'

            },
            // 🔥 Redefine ALL spacing (margin, padding, gap, etc.)
            spacing: {
                // Default Tailwind uses 0.25rem = 4px increments
                // Let's redefine with 8px base (like many design systems)
                0: '0px',
                1: '8px',      // was 4px
                2: '16px',     // was 8px
                3: '24px',     // was 12px
                4: '32px',     // was 16px
                5: '40px',     // was 20px
                6: '48px',
                7: '56px',
                8: '64px',
                9: '72px',
                10: '80px',
                12: '96px',
                16: '128px',
                20: '160px',
                24: '192px',
                32: '256px',
                40: '320px',
                48: '384px',
                56: '448px',
                64: '512px',
            }
        },
    },
    plugins: [],
}
