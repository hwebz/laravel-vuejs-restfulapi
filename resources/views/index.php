<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <style>
            [v-cloak] {
                display: none;
            }
        </style>
    </head>
    <body>
        <div id="app" v-cloak>
            {{ message }}
        </div>

        <div id="app-2">
            <span v-bind:title="message">
            Hover your mouse over me for a few seconds
            to see my dynamically bound title!
            </span>
        </div>
        
        <div id="app-3">
            <span v-if="seen">Now you see me</span>
        </div>

        <div id="app-4" v-cloak>
            <ul>
                <li v-for="todo in todos">{{ todo.text }}</li>
            </ul>
        </div>

        <div id="app-5">
            <p>{{message}}</p>
            <button v-on:click="reverseMessage">Reverse Message</button>
        </div>

        <div id="app-6" v-cloak>
            <ul>
                <li v-if="errors.error">There was an error: {{errors.error}}</li>
                <li v-else v-for="article in articles">
                    <h3>{{article.title}}</h3>
                    <p>{{article.body}}</p>
                </li>
            </ul>
        </div>
        <script src="https://unpkg.com/vue"></script>
        <script src="https://unpkg.com/vue-resource"></script>
        <script>
            var app = new Vue({
                el: '#app',
                data: {
                    message: 'Hello Vue!'
                }
            });

            var app2 = new Vue({
                el: '#app-2',
                data: {
                    message: 'You loaded this page on ' + new Date().toLocaleString()
                }
            });

            var app3 = new Vue({
                el: '#app-3',
                data: {
                    seen: true
                }
            });

            var app4 = new Vue({
                el: '#app-4',
                data: {
                    todos: [
                        { text: 'Learn JavaScript' },
                        { text: 'Learn Vue' },
                        { text: 'Build something awesome' }
                    ]
                }
            });

            var app5 = new Vue({
                el: '#app-5',
                data: {
                    message: 'Hello Vue.js!'
                },
                methods: {
                    reverseMessage: function() {
                        this.message = this.message.split('').reverse().join('');
                    }
                }
            });

            var app6 = new Vue({
                el: '#app-6',
                data: {
                    articles: [],
                    errors: []
                },
                created: function() {
                    Vue.http.headers.common['Authorization'] = 'Bearer fCaaBYxNyNetrMqxsfLsJwn9CmgJODgFGfunGeOILT6BmWKVWple3HvSzOVa';
                    this.$http.get('/api/articles').then(function(response) {
                        this.articles = response.body;
                    }, function(response) {
                        this.errors = response.body;
                    });
                }
            })
        </script>
    </body>
</html>
