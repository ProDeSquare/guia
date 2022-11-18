# Guía

Guía is an online example portal for FYP supervision system for [RIUF](https://www.riphahfsd.edu.pk/)

## Setup
In order to setup follow these guidelines.
- Install composer packages
    ```shell
    $ composer install
    ```
- Copy the environment file
    ```shell
    $ cp .env.example .env
    ```
- Generate app key
    ```shell
    $ php artisan key:generate
    ```
- Link `storage` directory to the `public` directory
    ```shell
    $ php artisan storage:link
    ```
- Create an empty database and fill in the credentials
    ```
    DB_DATABASE=guia
    DB_USERNAME=hamza
    DB_PASSWORD=1234
    ```
- Migrate the database
    ```shell
    $ php artisan migrate
    ```

## Enabling push notifications with firebase
Guía uses firebase to send push notifications in the browser. Log in to [firebase](https://firebase.google.com)
- Create a new firebase project
- Copy configuration keys and overwrite them to `/resources/views/layouts/app.blade.php` and `/public/firebase-messaging-sw.js`
- From the project's setting page, click on **cloud messaging** tab, copy **Server Key** and add that to `.env`
    ```
    FIREBASE_SERVER_KEY=your_server_key
    ```

## Running the project
```shell
$ php artisan serve
```

## Running unit tests
```shell
$ php artisan test
```

### License
**Guía** is licensed under the `GNU General Public License v3.0`. Checkout the [LICENSE](./LICENSE) file for more info.

### Contributors
- [Hamza Mughal](https://prodesquare.com)

### Special thanks to
- [Tabler.io](https://tabler.io/) for providing FOSS theme

### Contact
- Email: [hamza@prodesquare.com](mailto:hamza@prodesquare.com)

### Donate
- Bitcoin: `18Hd1waYh5uG6nWRboXGD3Q3vaPzWRMgQH`
- Ethereum: `0x90b3f1495724e9e6a18372cb939df1d7166337b9`
- Monero: `88ZscYwoNmTcf2xM1d6UFuGr2eyNh8V6kU2NkZFC7zTA84fWjjHMxrnDdHrquFm1sFRCvGXejvz2bBfBRZLNE5DQ3fngypz`
