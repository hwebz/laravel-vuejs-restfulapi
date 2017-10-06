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
        <a href="/next">Next page</a>
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
                <li v-for="(article, index) in articles" v-if="index < 3">
                    <h3>{{article.title}}</h3>
                    <p>{{article.body}}</p>
                </li>
            </ul>
        </div>

        <div id="app-7">
            <p v-once>{{ message.split('').reverse().join('') }}</p>
            <p>Computed reversed message: {{ reversedMessage }} (better than watch because it's cached)</p>
            <p>watch reversed message: {{ reversedMessageData }}</p>
            <input v-model="message" />
            <todo-item v-for="item in groceryList" v-bind:todo="item" v-bind:key="item.id"></todo-item>
        </div>

        <div id="app-8">
            <h3>Lifecycle</h3>
            <p v-html="hooks" v-bind:id="id" v-bind:class="className + '-string-concat'"></p>
            <button v-bind:disabled="isButtonDisabled">Disabled button</button>
        </div>
        
        <div id="app-9">
            <p v-if="seen">Now you see me</p>
            <a :href="googleLink" v-on:click="alertBeforeGo">Google</a>
            <form @submit.prevent="onSubmit" action="#">
                <button type="submit">Submit Form</button>
            </form>
        </div>
        <script src="https://unpkg.com/vue"></script>
        <script src="https://unpkg.com/vue-resource"></script>
        <script>
            Vue.component('todo-item', {
                props: ['todo'],
                template: '<li>{{ todo.text }}</li>'
            });

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
                    this.$http.get('/api/articles', {headers: { 'Authorization': 'Bearer fCaaBYxNyNetrMqxsfLsJwn9CmgJODgFGfunGeOILT6BmWKVWple3HvSzOVa' }}).then(function(response) {
                        this.articles = response.body;
                    }, function(response) {
                        this.errors = response.body;
                    });
                }
            });

            var app7 = new Vue({
                el: '#app-7',
                data: {
                    message: 'Hello Vue!',
                    groceryList: [
                        { id: 0, text: 'Vegetables' },
                        { id: 1, text: 'Cheese' },
                        { id: 2, text: 'Whatever else humans are supposed to eat' }
                    ],
                    reversedMessageData: 'Hello Vue!',
                    fullMessage: {
                        get: function() {
                            return this.message.split('').reverse().join(''); 
                        },
                        set: function(newValue) {
                            this.message = newValue.split('').reverse().join('');
                        }
                    }
                },
                computed: {
                    reversedMessage: function() {
                        return this.message.split('').reverse().join('');
                    }
                },
                watch: {
                    message: function(val) {
                        this.reversedMessageData = this.message.split('').reverse().join('');
                    }
                }
            });

            var app8 = new Vue({
                el: '#app-8',
                data: {
                    hooks: '',
                    id: 'custom-id',
                    className: 'custom-class',
                    isButtonDisabled: true
                },
                beforeCreate: function() {
                    this.hooks = '<h3>beforeCreate</h3>';
                },
                created: function() {
                    this.hooks = '<h3>created</h3>';
                },
                // beforeMount: function() {
                //     this.hooks = 'beforeMount';
                // },
                // mounted: function() {
                //     this.hooks = 'mounted';
                // },
                // beforeUpdate: function() {
                //     this.hooks = 'beforeUpdate';
                // },
                // updated: function() {
                //     this.hooks = 'updated';
                // },
                // beforeDestroy: function() {
                //     this.hooks = 'beforeDestroy';
                // },
                // destroyed: function() {
                //     this.hooks = 'destroyed';
                // }
            });

            var app9 = new Vue({
                el: '#app-9',
                data: {
                    seen: true,
                    googleLink: 'https://google.com'
                },
                methods: {
                    alertBeforeGo: function() {
                        alert('go to Google');
                    },
                    onSubmit: function() {
                        alert('submitted');
                    }
                }
            })
        </script>
    </body>
</html>
