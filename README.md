# Coodect Technologies
Hola!, Este es un desarrollo E-commerce open source creado con livewire v2, laravel v9, alpine js v3, by Coodect Technologies
  
## Dashboards
* Dashboard
	* General
	* E-commerce
	* Blogs
	* Correos web
## Funcionalidades web 📃
* Banners
* Galería
* Nosotros (Misión, Visión, Contacto)
* Socios
* Team
* Videos
* Servicios
* Portafolio
* Paquetes
    * Paquetes
    * Características
* Testimonios
* Preguntas y respuestas (FQA)
* Subscriptores (Newsletters)
* Correos web
* Blog
	* Post
	* Categorías
	* Etiquetas
* Información de contacto

## Funcionalidades e-ecommerce 📃​
* Ordenes
    * Crear ordenes
    * Actualizar status de las ordenes
    * Actualizar status del pago
    * Adjuntar números de guia
    * Posibilidad de reenviar correo de confirmación de orden
    * Posibilidad de reenviar correo de confirmación de pago
* Catalogo
	* Marcas
	* Género
	* Categorías multinivel (By parent id)
	* Productos
		* Colores
		* Medidas
		* Exportar productos con Excel
		* Importar productos con Excel
        * Importar productos de WordPress
        * Link de Amazón
        * Link de Mercado libre
        * Tipo digital y fisico
        * Producto fisico
        * Producto digital (PDF) Ej: (Libros digitales, Revistas, Licencias).
* Configurador de PC
    * Ensanblador de componentes y complementos
    * Compatibilidades de componentes
    * Presupuestos
    * Juegos
    * FPS
* Cuenta de usuario
    * Direcciones de envío
    * Direcciones de facturación
    * Productos digitales comprados
    * Ordenes
    * Perfil
    * Favoritos
* Reglas de mayoreo
* Promociones
* Cupones
* Análisis de busquedas de usuario
* Popup
* Zonas de envío
* Clases de envío
* Países
* Estados
* Monedas
* Información cuenta bancaria
* Pagos con PayPal
* Pagos con Stripe
* Pagos con Mercadopago
* Pagos con transferencia o deposito bancario
* Seguimiento de pedido

## Funcionalidades de sistema 📃​
* Usuarios
	* Perfil
	* Ordenes
	* Ingresos
	* Direcciones de envío
	* Logs
	* Roles
	* Permisos
	* Cuenta conectada a Google
* Notificaciones de sistema
	* Orden nueva
	* Subscriptor nuevo
	* Correo web nuevo
	* Comentario nuevo (producto o blog)
* Ajustes de sistema
    * Generales
	* Roles
	* Permisos
    * Logs
	* Copias de seguridad
	* Contacto
    * Zonas de envío
    * Clases de envío
    * Países
    * Estados
    * PopUp
    * Configurador PC
    * Monedas
    * Acceso a pasarelas de pago
    * Web
    * Etiquetas analiticas
    * Mailchimp
    * Google oauth2

## Funciones a destacar 😎
A continuación algunas opciones a destacar sobre el desarrollo

### Lenguaje y moneda segun su país
    Si un usuario de estados unidos entra a la ecommerce, esta lo detectará y el idioma y la moneda cambiarán a 
    la del país, esto aplica si la moneda esta activa dentro del sistema, por default lo esta.

### Copias de seguridad
	Por cada copia de seguridad de la base de datos, se mandará esta copia de seguridad al correo 
	que se te fue creado en el proyecto. Así teniendo siempre copias de seguridad en la nube 
	mediante el correo electrónico.
		
### Datos estadísticos
	Cada producto y blog creado almacenará aquellas visitas que recopila de cada usuario 
	que visita el producto / blog creado. 
	Adjuntando en el sistema graficas que representen estos comportamientos a lo largo del tiempo.

### Ordenes express WhatsApp
    Capacidad para poder mandar los productos del carrito al WhastApp del propietario de la e-commerce (Usted).
    
### Productos
	Capacidad para exportar productos masivamente con excel
	Capacidad para importar productos masivamente con excel
	Capacidad para importar productos masivamente de WordPress
    Recordatorio de carrito olvidado via email automatizado
    Un producto puede ser fisico o digital

### Sitemap
	Automatización de generar un archivo sitemap.xml encargado de hacerle saber a Google que hay nuevo contenido en caso de que haya nuevo contenido creado en la página, (Nuevo producto, nuevo blog, etc).

### Imágenes
	Toda imagen insertada en el sistema será optimizada
	Toda imagen será convertida a formato webp por motivos de estándares  de Google
	Imágenes en webp aumentan la optimización a nivel de página web

### Susplantar usuario
	Podrás susplantar la identidad de cualquier usuario tomando su sesión, rol y sus permisos

### Dashboard general
	Conoce inmediatamente lo siguiente
	* Cantidad de post
	* Cantidad de ordenes
	* Cantidad de comentarios
	* Cantidad de correos web
	* Últimas 3 ordenes
	* Últimos 3 post
	* Últimos logs
	* Últimos correos web

### Dashboard ordenes
	* Ingresos por día
	* Ingresos por mes
	* Ingresos total
	* Cantidad de ordenes procesando
	* Cantidad de ordenes completas
	* Cantidad de ordenes canceladas
	* Cantidad de productos publicados
	* Cantidad de productos en borrador
	* Cantidad de comentarios aprobados
	* Cantidad de productos NO aprobados
	* Gráfica de ingresos del año
	* Gráfica de cantidades de ordenes agrupadas por status (Completadas, Procesando, Canceladas)
	* Listado de ordenes procesando
	* Listado de ordenes recientes
	* Listado de los productos más vendidos
	* Listado de los productos más vistos
	* Listado de productos con un stock bajo
	* Listado de comentarios no aprobados

# ¿Eres desarrollador? 
De ser así puedes seguir leyendo la documentación para su mantenimiento a futuro.

## Templates utilizados 🌐​
* Metronic v8 (admin) Link download: https://drive.google.com/file/d/1-NaTqUfvg2gU6s2ccUd19mqtkdLNhzD8/view?usp=sharing
* Wolmart v1 (E-commerce) Link download: https://drive.google.com/file/d/1-SSEIkyNflYPw-_c7eGvFR1elvXkrrk7/view?usp=sharing

## Comenzando ​🕛​
Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local._

### Pre-requisitos 📃​
_Que cosas necesitas para instalar el software y como instalarlas_

```
1.- PHP v8.1+

2.- Servidor XAMMP, WAMPP o Laragon

```

### Opción (A): Instalación 🔧
_1.- Deberás de instalar las dependencias de laravel con el siguiente comando_

```
git clone https://github.com/CoodectTechnologies/LaraShop---Big-eCommerce-Laravel-9.git

composer install

```

_2.- Una vez que se terminen de descargar el proyecto y las dependencias_

```
php artisan key:generate
```

_3.- Deberás de rellenar las variables del archivo .env.example, una vez finalizado le podrás cambiar el nombre a .env_
__

_4.- Ejecutando las migraciones_

```
php artisan migrate:fresh --seed

```
_4.- Ejecutando storage link_

```
php artisan storage:link

```

### Opción (B): Instalación con  docker compose
- `git clone https://github.com/CoodectTechnologies/LaraShop---Big-eCommerce-Laravel-9.git && cd laraShop---big-ecommerce-laravel-9`
- `cp .env.example .env`
- `docker compose up -d --build` ( despues configurar credenciales de email)
- `docker compose exec app sh -s 'composer install'`
- `docker compose exec app sh -s 'php artisan key:generate'`
- `docker compose exec app sh -s 'php artisan migrate:fresh --seed'`
- `docker compose exec app sh -s 'php artisan storage:link'`

Acceder al administrador: https://localhost/admin
Acceder al e-commerce: https://localhost/

Correo admin: coodect.manager@gmail.com
Contraseña admin: coodect2020

### Opción (C): Instalación semi-automatica (RECOMENDADA)🔧
_1.- Deberás de instalar las dependencias de laravel con el siguiente comando_

```
git clone https://github.com/CoodectTechnologies/LaraShop---Big-eCommerce-Laravel-9.git

```

```
cd laraShop---big-ecommerce-laravel-9
```

```
composer install
```

_2.- Una vez que se terminen de descargar el proyecto y las dependencias_

Podrás acceder a tu proyecto https://localhost donde a partir de aquí podrás realizar una instalación y configuración visual
Una vez finalices los pasos del instalador visual, en consola procede a ejecutar el comando storage:link

```
php artisan storage:link
```

Una vez finalizado el comando storage:link podrás hacer caso omiso al siguiente paso: Configuración ⚙️

### Configuración ​⚙️​

**Correo:**
_1.- Deberás de configurar las variables de entorno MAIL con tus datos de acceso de tu dominio o datos de prueba con mailtrap o el que prefieras. Esto para el funcionamiento de envíos de correo._

**Google Socialite:**
_1.- Habilitar la API de google analytics en [Console Cloud Google](https://console.cloud.google.com/)_
_2.- Deberás de obtener tus credenciales y remplazar las variables de GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET, GOOGLE_REDIRECT_URL_

## Ejecutar comando schedule ​⚙️​
**_El sistema cuenta con 3 comandos por default en Kernel_**

**_backup:run --only-db este comando generará una copia de tu base de datos semanalmente y la enviará al correo que tengas en tu variable de .env DB_BACKUP_EMAIL_**

**_sitemap:generate este comando generará un archivo sitemap.xml en tu carpeta public, con todas las rutas publicas que crees en el sistema_**

**_queue:work --stop-when-empty este comando ejecutará todas las colas que vallas a tener en el sistema_**

## Herramientas ​​✒️
**_Dependencias de laravel que ayudaron a la construcción del proyecto_**
```
    * "amrshawky/laravel-currency": "^5.0",
    * "asantibanez/livewire-charts": "^2.4",
    * "cviebrock/eloquent-sluggable": "^8.0",
    * "cyrildewit/eloquent-viewable": "^6.1",
    * "dompdf/dompdf": "^1.2",
    * "guzzlehttp/guzzle": "^7.0.1",
    * "hardevine/shoppingcart": "^3.1",
    * "intervention/image": "^2.7",
    * "jackiedo/dotenv-editor": "^2.0",
    * "laravel/socialite": "^5.5",
    * "laravel/ui": "^3.4",
    * "livewire/livewire": "^2.10",
    * "lukeraymonddowning/honey": "^0.3.4",
    * "maatwebsite/excel": "^3.1",
    * "mercadopago/dx-php": "^2.4",
    * "spatie/array-to-xml": "^2.16",
    * "spatie/laravel-activitylog": "^3.17",
    * "spatie/laravel-backup": "^6.16",
    * "spatie/laravel-permission": "^5.5",
    * "spatie/laravel-sitemap": "^5.9",
    * "spatie/laravel-translatable": "^4.6",
    * "stevebauman/location": "^6.5",
    * "stripe/stripe-php": "^10.3"
```
## Autor ❤️
* **Agencia en desarrollo de software** - [www.coodect.com] SEO Rigoberto Villa Rodríguez 😊
---

## Capturas

![Preview](/public/assets/readme/install/install-1.jpeg)
![Preview](/public/assets/readme/install/install-2.jpeg)
![Preview](/public/assets/readme/install/install-3.jpeg)
![Preview](/public/assets/readme/install/install-4.jpeg)
![Preview](/public/assets/readme/install/install-5.jpeg)

![Preview](/public/assets/readme/c1.png)
![Preview](/public/assets/readme/c2.png)
![Preview](/public/assets/readme/c3.png)
![Preview](/public/assets/readme/c4.png)
![Preview](/public/assets/readme/c5.png)
![Preview](/public/assets/readme/c6.jpeg)
![Preview](/public/assets/readme/c7.png)
![Preview](/public/assets/readme/c8.png)
![Preview](/public/assets/readme/c9.png)
![Preview](/public/assets/readme/c10.png)
![Preview](/public/assets/readme/c11.png)
![Preview](/public/assets/readme/c12.png)
![Preview](/public/assets/readme/c13.png)
![Preview](/public/assets/readme/c14.jpeg)
![Preview](/public/assets/readme/c15.jpeg)
![Preview](/public/assets/readme/c16.jpeg)


## Donaciones

Puedes apoyar este proyecto mediante una donación a través de PayPal:

[![Donar con PayPal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/donate/?hosted_button_id=PFH7YEE7C6KQ6)
