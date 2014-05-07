<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {% for value in config.css %}
            <script src="{{ value }}"></script>
        {% endfor %}
        {{ stylesheet_link('css/style.css') }}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Ryan Walters">
    </head>
    <body>
        <div class="container">
            {{ content() }}
        </div>
        {% for value in config.js %}
            <script src="{{ value }}"></script>
        {% endfor %}
        {{ javascript_include('js/app.js') }}
        {% if extraScripts is defined %}
            {% for value in extraScripts %}
                <script src="{{ value }}"></script>
            {% endfor %}
        {% endif %}
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-00000-0', 'ryanwalters.co');
            ga('send', 'pageview');
        </script>
    </body>
</html>