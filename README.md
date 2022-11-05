<p align="center"><a href="https://laravel.com" target="_blank" ><img src="https://github.com/DelwarSumon/bookmark-manager/blob/main/public/readme_images/Bookmark_Manager.png?raw=true"></a></p>

## About Bookmark Manager

The Bookmark manager is a system that’s similar to how the bookmarking is done in a browser. You can bookmark URLs and organize them in different folders.


### Installation Procedure

* git clone https://github.com/DelwarSumon/bookmark-manager.git
* change your directory to bookmark-manager (`cd bookmark-manager`)
* composer install

### Database Connection 
###### (Update on `.env` file)
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

###### Note: I have added my testing records csv files here <a href="https://github.com/DelwarSumon/bookmark-manager/tree/main/public/DB%20Tables%20CSV`" target="_blank">https://github.com/DelwarSumon/bookmark-manager/tree/main/public/DB%20Tables%20CSV</a>

### API Endpoints
<b>`Note: "YOUR-DOMAIN" - means project path, like - http://localhost/bookmark-manager`</b>

<b>Bookmarks</b>
* `GET` Get a list of bookmarks
<pre><code><b>URL:</b> YOUR-DOMAIN/api/v1/bookmarks

<b>Parameters (Optional):</b>
<b>page</b> - integer (Default 1)
<b>per_page</b> - integer (Default 10)
<b>sort_by</b> - string (Default "id")
<b>sort_order</b> - string (Default "asc")
</code></pre>

###### You can use <a href="https://www.postman.com/downloads/" target="_blank"><b>Postman</b></a> to test API request
<p align="center"><img src="https://github.com/DelwarSumon/bookmark-manager/blob/main/public/readme_images/Get_Bookmark.png?raw=true"></p>

* `GET` Get a list of bookmarks for a folder

<pre><code><b>URL:</b> YOUR-DOMAIN/api/v1/bookmarks/folders/FOLDER_ID

<b>Parameters (Optional):</b>
<b>page</b> - integer (Default 1)
<b>per_page</b> - integer (Default 10)
<b>sort_by</b> - string (Default "id")
<b>sort_order</b> - string (Default "asc")
</code></pre>

<p align="center"><img src="https://github.com/DelwarSumon/bookmark-manager/blob/main/public/readme_images/Get_Bookmark_Folder.png?raw=true"></p>

* `POST` Create a new bookmark
<pre><code><b>Url:</b> YOUR-DOMAIN/api/v1/bookmarks
<b>Fields:</b> 
"name" - String
"url" - URL
"folder_id" - Integer (Optional)
</code></pre>

<p align="center"><img src="https://github.com/DelwarSumon/bookmark-manager/blob/main/public/readme_images/Create_Bookmark.png?raw=true"></p>

* `PUT` Update a bookmark
<pre><code><b>Url:</b> YOUR-DOMAIN/api/v1/bookmarks/BOOKMARK_ID
<b>Fields:</b> 
"name" - String
"url" - URL
"folder_id" - Integer (Optional)
</code></pre>

<p align="center"><img src="https://github.com/DelwarSumon/bookmark-manager/blob/main/public/readme_images/Update_Bookmark.png?raw=true"></p>

* `DELETE` Delete a bookmark
<pre><code><b>Url:</b> YOUR-DOMAIN/api/v1/bookmarks/BOOKMARK_ID
</code></pre>

<p align="center"><img src="https://github.com/DelwarSumon/bookmark-manager/blob/main/public/readme_images/Delete_Bookmark.png?raw=true"></p>

<b>Folder</b>
* `GET` Get a list of folders
<pre><code><b>URL:</b> YOUR-DOMAIN/api/v1/folders

<b>Parameters (Optional):</b>
<b>page</b> - integer (Default 1)
<b>per_page</b> - integer (Default 10)
<b>sort_by</b> - string (Default "id")
<b>sort_order</b> - string (Default "asc")
</code></pre>

<p align="center"><img src="https://github.com/DelwarSumon/bookmark-manager/blob/main/public/readme_images/Get_Folder.png?raw=true"></p>

* `POST` Create a new folder
<pre><code><b>Url:</b> YOUR-DOMAIN/api/v1/folders
<b>Fields:</b> 
"name" - String
"url" - URL
"folder_id" - Integer (Optional)
</code></pre>

<p align="center"><img src="https://github.com/DelwarSumon/bookmark-manager/blob/main/public/readme_images/Create_Folder.png?raw=true"></p>

* `PUT` Update a folder
<pre><code><b>Url:</b> YOUR-DOMAIN/api/v1/folders/FOLDER_ID
<b>Fields:</b> 
"name" - String
"url" - URL
"folder_id" - Integer (Optional)
</code></pre>

<p align="center"><img src="https://github.com/DelwarSumon/bookmark-manager/blob/main/public/readme_images/Update_Folder.png?raw=true"></p>

* `DELETE` Delete a folder
<pre><code><b>Url:</b> YOUR-DOMAIN/api/v1/folders/FOLDER_ID
</code></pre>

<p align="center"><img src="https://github.com/DelwarSumon/bookmark-manager/blob/main/public/readme_images/Delete_Folder.png?raw=true"></p>

