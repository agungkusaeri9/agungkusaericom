import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss", // Ganti ini
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
});
