## Project installation

<p>1. Clone this repository to your local dev environment.</p>
<p>2. Run <i>composer install</i> to install composer dependencies</p>
<p>3. Run <i>npm install</i> to install package.json dependencies</p>
<p>4. Run <i>npm run prod</i> to compile assets</p>
<p>5. Run <i>cp .env.example .env</i> to create environment file</p>
<p>6. Populate DB_DATABASE, DB_USERNAME, DB_PASSWORD with your own values in your .env file</p>
<p>7. Run <i>php artisan key:generate</i> to create app key</p>
<p>8. Run <i>php artisan migrate --seed</i> to seed database with tables and demo data</p>
<p>9. Run <i>php artisan serve</i> if needed.</p>

And you are good to go.
