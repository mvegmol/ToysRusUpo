# ToysRusUpo

Miguel Vega Molina, Carlos Vega Molina, Alejandro Vázquez Rodríguez

## Ejecutar el proyecto

- cambiar el nombre del archivo .env.example a .env
- composer install
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- npm install bootstrap --save-dev
- npm install sass --save-dev
- npm install bootstrap-icons
- php artisan key:generate

## Instalar Tailwind Css

- npm install -D tailwindcss postcss autoprefixer
- npx tailwindcss init -p
- En el archivo tailwind.config.js

  // tailwind.config.js
  module.exports = {
  content: [
  './resources/**/*.blade.php',
  './resources/**/*.js',
  './resources/**/*.vue',
  ],
  theme: {
  extend: {
  colors: {
  primary: {
  DEFAULT: '#00FA9A', // Verde agua como color primario
  },
  },
  },
  },
  plugins: [],
  };

## Cuenta del MailTrap

Correo: mvegmol@alu.upo.es
Password: 123456

##Cuenta administrado de la APP
correo: admin@admin.com
Password:admin
