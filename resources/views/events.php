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
        
        <div id="app">
            <button v-on:click="counter += 1">Add 1</button>
            <p>The button above has been clicked {{ counter }} times.</p>
            <button v-on:click="greet">Say hello</button>
            <button v-on:click.self.prevent="say('yeah')">Say yeah</button>
            <button v-on:click.stop.prevent="say('what')">Say what</button>
            <button v-on:click.once="warn('Form cannot be submitted yet.', $event)">Submit</button>
            <input v-on:keyup.13="submit">
            <!-- <input v-on:keyup.enter="submit">
            <input @keyup.enter="submit"> -->

            <!-- Alt + C -->
            <input @keyup.alt.67="clear">

            <!-- Ctrl + Click -->
            <div @click.ctrl="doSomething">Do something</div>
            <button @click.left.stop.prevent="mouse('left mouse')">Left mouse click</button>
            <button @click.middle.stop.prevent="mouse('middle mouse')">Middle mouse click</button>
            <button @click.right.stop.prevent="mouse('right mouse')">Right mouse click</button>

            <div>
                <input v-model="message" placeholder="edit me">
                <p>Message is: {{ message }}</p>
            </div>

            <div>
                <span>Multiline message is:</span>
                <p style="white-space: pre-line;">{{ message }}</p><br>
                <textarea v-model="message" placeholder="add multiple lines"></textarea>
            </div>

            <div>
                <input type="checkbox" id="checkbox" v-model="checked">
                <label for="checkbox">{{ checked }}</label>
            </div>

            <div>
                <input type="checkbox" id="jack" value="Jack" v-model="checkedNames">
                <label for="jack">Jack</label>
                <input type="checkbox" id="john" value="John" v-model="checkedNames">
                <label for="john">John</label>
                <input type="checkbox" id="mike" value="Mike" v-model="checkedNames">
                <label for="mike">Mike</label>
                <br>
                <span>Checked names: {{ checkedNames }}</span>
            </div>

            <div>
                <input type="radio" id="one" value="One" v-model="picked">
                <label for="one">One</label>
                <br>
                <input type="radio" id="two" value="Two" v-model="picked">
                <label for="two">Two</label>
                <br>
                <span>Picked: {{ picked }}</span>
            </div>

            <div>
                <select v-model.lazy="selected">
                    <option disabled value="">Please select one</option>
                    <option v-for="option in options" v-bind:value="option.value">
                        {{ option.text }}
                    </option>
                </select>
                <span>Selected: {{ selected }}</span>

                <select v-model="selectedList" multiple>
                    <option disabled value="">Please select one</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                </select>
                <span>Selected: {{ selectedList }}</span>
            </div>
        </div>

        <script src="https://unpkg.com/vue"></script>
        <script src="https://unpkg.com/vue-resource"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
        <script src="https://unpkg.com/lodash"></script>
        <script>
            Vue.config.keyCodes.f1 = 112;

            var app = new Vue({
                el: '#app',
                data: {
                    counter: 0,
                    name: 'Vue.js',
                    message: '',
                    checked: false,
                    checkedNames: [],
                    picked: '',
                    selected: '',
                    selectedList: [],
                    options: [
                        { text: 'One', value: 'A' },
                        { text: 'Two', value: 'B' },
                        { text: 'Three', value: 'C' }
                    ]
                },
                methods: {
                    greet: function(event) {
                        alert('Hello ' + this.name + '!');
                        if (event) {
                            alert(event.target.tagName);
                        }
                    },
                    say: function(message) {
                        alert(message);
                    },
                    warn: function(message, event) {
                        if (event) event.preventDefault();
                        alert(message);
                    },
                    submit: function() {
                        alert('You press key have keyCode is 13');
                    },
                    clear: function() {
                        alert('cleared');
                    },
                    doSomething: function() {
                        alert('Do something');
                    },
                    mouse: function(pos) {
                        alert(pos);
                    }
                }
            })
        </script>
    </body>
</html>
