Markdown CMS
==

This is a plugin for Agile Toolkit, which will greatly help you to display 
Markdown content on your pages. To use it, add this to your Frontend.php
/ init():

    $this->add('romaninsh/mdcms/Controller');


then create "content" folder inside your `interface` folder

    frontend
      + page
      + lib
      + public
      + content
      
Create `content/hello.md` then open `frontend/public/hello` in your browser and you should see your markdown there displayed in real-time.

Features and Components
--
This plugin can be integrated in various ways. The integration above is a full integration, but you can also use individual components.

 - Application Controller - Full-featured integration, one-line use.
 - romaninsh/mdcms/Page - Extension to page capable of mixing regular templates with Markdown.
 - `{markdown} .. {/}` - Allows you to embed markdown inside regular ATK template
 - `{markdown_include}disclaimer{}` - Include markdown file. I recommend to start includes with underscore, this way they can't be accessed directly.

 
Caching
--
This add-on has a support for Models. This enables use of transparent caching and / or storing templates in a dedicated storage. For example to store templates in memcache, the following can be used:
    
    $this->add('romaninsh/mdcms/Controller')
        ->setModel('romaninsh/mdcms/Model')
        ->setSource('Memcached');

Resource
--
The .md files are stored inside 'content' folder by default, but you can add more through adding more extensions through pathfinder. The resource type is `content`.