<p align="center"><a href="https://laravel.com" target="_blank" ><img src="https://github.com/DelwarSumon/bookmark-manager/blob/main/public/Bookmark_Manager.png?raw=true"></a></p>

## About Bookmark Manager

The Bookmark manager is a system that’s similar to how the bookmarking is done in a browser. You can bookmark URLs and organize them in different folders.


### Installation Procedure

* git clone https://github.com/DelwarSumon/bookmark-manager.git
* change your directory to bookmark-manager (`cd bookmark-manager`)
* composer install

### Database Connection
* DB_CONNECTION=pgsql
* DB_HOST=127.0.0.1
* DB_PORT=YOUR_DB_PORT //5432
* DB_DATABASE=YOUR_DB_NAME //bookmark_manager
* DB_USERNAME=YOUR_DB_USER_NAME //postgres
* DB_PASSWORD=YOUR_DB_PASSWORD

### Migrate Tables
* Run `php artisan migrate`

### If you face any problem on migration like `Upgrade postgre lib file` , `Authentication Error` 
### You can also create tables in `pgadmin` by run below query -
* To create `Folders` table
<pre><code>CREATE TABLE folders (
    id SERIAL PRIMARY KEY, 
    name varchar(255) NOT NULL,
    description text Default NULL,
    created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
);</code></pre>

* To create `Bookmarks` table
<pre><code>CREATE TABLE bookmarks (
    id SERIAL PRIMARY KEY, 
    name varchar(255) NOT NULL,
    url text NOT NULL,
    folder_id int Default NULL,
    created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMPTZ NOT NULL DEFAULT NOW()
);</code></pre>

### If you want to import existing data from CSV file
* Open <b>psql shell</b>
* For <b>Folders</b> Table
<pre><code>\copy folders from 'YOUR_CSV_FILE_PATH\YOUR_FILE_NAME.csv' DELIMITER ',' CSV HEADER;</code></pre>
* For <b>Bookmarks</b> Table
<pre><code>\copy bookmarks from 'YOUR_CSV_FILE_PATH\YOUR_FILE_NAME.csv' DELIMITER ',' CSV HEADER;</code></pre>

### API Endpoints
<b>`Note: "YOUR-DOMAIN" - means project path, like - http://localhost/bookmark-manager`</b>

<b>Bookmarks</b>
* `GET` Get a list of bookmarks
<pre><code> 
<b>URL:</b> YOUR-DOMAIN/api/v1/bookmarks?per_page=10&page=1&sort_by=id&sort_order=asc

<b>Parameters:</b>
<b>page</> - integer (Default 1)
<b>per_page</> - integer (Default 10)
<b>sort_by</> - string (Default "id")
<b>sort_order</> - string (Default "asc")
</code></pre>

* `GET` Get a list of bookmarks for a folder
<pre><code> 
<b>URL:</b> YOUR-DOMAIN/api/v1/bookmarks/folders/FOLDER_ID?per_page=10

<b>Parameters:</b>
<b>page</> - integer (Default 1)
<b>per_page</> - integer (Default 10)
<b>sort_by</> - string (Default "id")
<b>sort_order</> - string (Default "asc")
</code></pre>

* `POST` Create a new bookmark
<pre><code>
<b>Url:</b> YOUR-DOMAIN/api/v1/bookmarks
<b>Fields:</b> 
"name" - String
"url" - URL
"folder_id" - Integer (Optional)
</code></pre>

* `PUT` Update a bookmark
YOUR-DOMAIN/api/v1/bookmarks/BOOKMARK_ID

* `DELETE` Delete a bookmark
YOUR-DOMAIN/api/v1/bookmarks/BOOKMARK_ID

* `PUT` Update a bookmark
YOUR-DOMAIN/api/v1/bookmarks/BOOKMARK_ID

* `DELETE` Delete a bookmark
YOUR-DOMAIN/api/v1/bookmarks/BOOKMARK_ID



