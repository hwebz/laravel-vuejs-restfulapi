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
            .active {
                color: green;
            }

            .text-danger {
                background-color: red;
            }
        </style>
    </head>
    <body>
        <a href="/todo">Todo list app</a>
        <div id="app" v-cloak>
            <ul id="example-1">
                <li v-for="item in items">
                    {{ item.message }}
                </li>
            </ul>
            <ul id="example-2">
                <li v-for="(item, index) of items">
                    {{ parentMessage }} - {{ index }} - {{ item.message }}
                </li>
            </ul>
        </div>

        <div id="app-3">
            <ul>
                <li v-for="value in object">
                    {{ value }}
                </li>
            </ul>

            <ul>
                <li v-for="(value, key) in object">
                    {{ key }} : {{ value }}
                </li>
            </ul>
            
            <ul>
                <li v-for="(value, key, index) in object">
                    {{ index }}. {{ key }}: {{ value }}
                </li>
            </ul>

            <ul>
                <li v-for="value in object" :key="value.id">
                    {{ value }}
                </li>
            </ul>
        </div>

        <div id="app-4">
            <h3>Filtered array</h3>
            <ul>
                <li v-for="n in evenNumbers">{{ n }}</li>
            </ul>
            <ul>
                <li v-for="n in even(numbers)">{{ n }}</li>
            </ul>
            <ul>
                <li v-for="n in 10">{{ n }}</li>
            </ul>
            <ul>
                <template v-for="item in items">
                    <li>{{ item.message }}</li>
                </template>
            </ul>
            <ul v-if="todos.length">
                <li v-for="todo in todos" v-if="!todo.isComplete">{{ todo.text }}</li>
            </ul>
            <p v-else>No todos left!</p>
            <ul v-if="todos.length">
                <todo-item v-for="todo in todos" v-if="!todo.isComplete" v-bind:todo="todo" :key="todo.id"></todo-item>
            </ul>
            <p v-else>No todos left!</p>
        </div>

        <script src="https://unpkg.com/vue"></script>
        <script src="https://unpkg.com/vue-resource"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
        <script src="https://unpkg.com/lodash"></script>
        <script>
            Vue.component('todo-item', {
                props: ['todo'],
                template: '<li>{{ todo.text }}</li>'
            });

            var app = new Vue({
                el: '#app',
                data: {
                    parentMessage: 'Parent message',
                    items: [
                        {id: 1, message: 'This is the test message'},
                        {id: 2, message: 'This is the second test message'},
                        {id: 3, message: 'This is the third test message'},
                        {id: 4, message: 'This is the forth test message'}
                    ]
                }
            });

            var app3 = new Vue({
                el: '#app-3',
                data: {
                    object: {
                        id: 1,
                        firstName: 'John',
                        lastName: 'Doe',
                        age: 30
                    }
                }
            });

            var app4 = new Vue({
                el: '#app-4',
                data: {
                    numbers: [1, 2, 3, 4, 5],
                    items: [
                        {message: 'First message'},
                        {message: 'Second message'},
                        {message: 'Third message'}
                    ],
                    todos: [
                        {id: 1, text: 'First thing to do', isComplete: true},
                        {id: 2, text: 'Second thing to do', isComplete: true},
                        {id: 3, text: 'Third thing to do', isComplete: false},
                        {id: 4, text: 'Forth thing to do', isComplete: false}
                    ]
                },
                computed: {
                    eventNumbers: function() {
                        return this.numbers % 2 === 0;
                    }
                },
                methods: {
                    even: function(numbers) {
                        return this.numbers.filter(function(number) {
                            return number % 2 === 0;
                        })
                    }
                }
            });
        </script>
    </body>
</html>
