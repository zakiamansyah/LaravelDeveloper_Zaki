## Project Setup

### Prerequisites

- PHP >= 7.3
- Composer

### Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/zakiamansyah/LaravelDeveloper_Zaki.git
    cd LaravelDeveloper_Zaki
    ```

2. Install dependencies:
    ```sh
    composer install
    ```

3. Copy the [.env.example](http://_vscodecontentref_/1) file to [.env](http://_vscodecontentref_/2) and configure your environment variables:
    ```sh
    cp .env.example .env
    ```

4. Generate an application :
key    ```sh
    php artisan key:generate
    ```

5. Run database migrations:
    ```sh
    php artisan migrate
    ```
6. Start the development server:
    ```sh
    php artisan serve
    ```