# laravel-api-exercise

This project contains resources that have been implemented for my personal exercise.

## Requirements

List of requirements to run the project:

- PHP version 8.1 or later
- MySQL 8.0.x
- Composer 2.x

## Installation

1. Clone this repository: `git clone https://github.com/ifaniqbal/laravel-api-exercise.git`.
2. Install dependencies: `composer install`.
3. Copy `.env.example` to `.env` and update the database information.
4. Generate an application key: `php artisan key:generate`.
5. Run database migrations: `php artisan migrate`.
6. Start the development server: `php artisan serve`.

## Usage

If you are using Postman, you can import `Laravel API Exercise.postman_collection.json` file in the root directory
to easily test the API. The complete list of available endpoints is as follows:

```text
  GET       api/categories ................... categories.index › CategoryController@index
  POST      api/categories ................... categories.store › CategoryController@store
  GET       api/categories/{category} .......... categories.show › CategoryController@show
  PUT       api/categories/{category} ...... categories.update › CategoryController@update
  DELETE    api/categories/{category} .... categories.destroy › CategoryController@destroy
  GET       api/images .............................. images.index › ImageController@index
  POST      api/images .............................. images.store › ImageController@store
  GET       api/images/{image} ........................ images.show › ImageController@show
  PUT       api/images/{image} .................... images.update › ImageController@update
  DELETE    api/images/{image} .................. images.destroy › ImageController@destroy
  GET       api/products ........................ products.index › ProductController@index
  POST      api/products ........................ products.store › ProductController@store
  GET       api/products/{product} ................ products.show › ProductController@show
  PUT       api/products/{product} ............ products.update › ProductController@update
  DELETE    api/products/{product} .......... products.destroy › ProductController@destroy
```

## Contributing

1. Fork the project
2. Create a new branch: `git checkout -b feature/new-feature`
3. Make changes and commit them: `git commit -am 'feat: new feature'`. Please
   follow [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/)
4. Push to the branch: `git push origin feature/new-feature`
5. Create a pull request

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
