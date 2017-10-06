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
        <div id="app" v-cloak>
            <p>
                Ask a yes/no question:
                <input v-model="question" />
            </p>
            <p>{{ answer }}</p>
            <p><img :src="answerThumb"></p>
        </div>
        
        <div id="app-2">
            <p v-bind:class="{ active: isActive, 'text-danger': hasError}" v-on:click="toggleClass">class active &amp; text-dander</p>
            <p v-bind:class="objectClass">Styled element</p>
            <p v-bind:class="classObject2">Styled element</p>
            <p v-bind:class="[activeClass, errorClass]">class array</p>
            <p v-bind:class="[isActive ? activeClass : '', errorClass]">class array with tenary condition</p>
            <p v-bind:class="[{active: isActive}, errorClass]">class array with curly braces syntax</p>
        </div>

        <div id="app-3">
            <my-comp class="baz boo" v-bind:class="{ active: isActive }"></my-comp>
        </div>

        <div id="app-4">
            <p v-bind:style="{color: activeColor, fontSize: fontSize + 'px'}">Inline Style</p>
            <p v-bind:style="styleObject">Inline style using styleObject</p>
            <p v-bind:style="{ display: ['-webkit-box', '-ms-flexbox', 'flex']}"></p>
        </div>
        
        <script src="https://unpkg.com/vue"></script>
        <script src="https://unpkg.com/vue-resource"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
        <script src="https://unpkg.com/lodash"></script>
        <script>
            Vue.component('my-comp', {
                template: '<p class="foo bar">Hi</p>'
            });

            var app = new Vue({
                el: '#app',
                data: {
                    question: '',
                    answer: 'I cannot give you an answer until you ask a question!',
                    answerThumb: ''
                },
                watch: {
                    question: function(newQuestion) {
                        this.answer = 'Waiting for you to stop typing...';
                        this.getAnswer();
                    }
                },
                methods: {
                    getAnswer: _.debounce(function() {
                        if (this.question.indexOf('?') === -1) {
                            this.answer = 'Questions usually contain a question mark. ;-)';
                            return;
                        }

                        this.answer = 'Thinking...';
                        var vm = this;

                        axios.get('https://yesno.wtf/api')
                            .then(function(response) {
                                vm.answer = _.capitalize(response.data.answer);
                                vm.answerThumb = response.data.image;
                            })
                            .catch(function(error) {
                                vm.answer = 'Error! Could not reach the API. ' + error;
                            });
                    }, 500)
                }
            });

            var app2 = new Vue({
                el: '#app-2',
                data: {
                    isActive: true,
                    hasError: false,
                    objectClass: {
                        active: true,
                        'text-danger': true
                    },
                    activeClass: 'active',
                    errorClass: 'text-danger'
                },
                methods: {
                    toggleClass: function() {
                        this.isActive = !this.isActive;
                        this.hasError = !this.hasError;
                    }
                },
                computed: {
                    classObject2: function() {
                        return {
                            active: this.isActive,
                            'text-danger': this.hasError
                        }
                    }
                }
            });

            var app3 = new Vue({
                el: '#app-3',
                data: {
                    isActive: true
                }
            });

            var app4 = new Vue({
                el: '#app-4',
                data: {
                    activeColor: '#f00',
                    fontSize: 20,
                    styleObject: {
                        color: '#0f0',
                        fontSize: '25px'
                    }
                }
            })
        </script>
    </body>
</html>
