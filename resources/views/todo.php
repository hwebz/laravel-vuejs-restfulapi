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
        <a href="/events">Event Handling</a>
        <div id="todo-list-example">
            <input v-model="newTodoText" v-on:keyup.enter="addNewTodo" placeholder="Add a todo" />

            <ul>
                <li is="todo-item" 
                    v-for="(todo, index) in todos"
                    v-bind:key="todo.id"
                    v-bind:title="todo.title"
                    v-on:remove="todos.splice(index, 1)"></li>
            </ul>
        </div>

        <script src="https://unpkg.com/vue"></script>
        <script src="https://unpkg.com/vue-resource"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
        <script src="https://unpkg.com/lodash"></script>
        <script>
            Vue.component('todo-item', {
                template: '<li>{{ title }} <button v-on:click="$emit(\'remove\')">X</button></li>',
                props: ['title']
            });

            var todoList = new Vue({
                el: '#todo-list-example',
                data: {
                    todos: [
                        {
                            id: 1,
                            title: 'Do the dishes'
                        },
                        {
                            id: 2,
                            title: 'Take out of the trash'
                        },
                        {
                            id: 3,
                            title: 'Mow the lawn'
                        }
                    ],
                    nextTodoId: 4
                },
                methods: {
                    addNewTodo: function() {
                        this.todos.push({
                            id: this.nextTodoId++,
                            title: this.newTodoText
                        });
                        this.newTodoText = '';
                    }
                }
            });
        </script>
    </body>
</html>
