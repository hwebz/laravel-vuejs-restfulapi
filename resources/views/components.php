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
            <input v-model="parentMsg">
            <simple-counter :my-message.sync="parentMsg" v-on:click.native="doTheThing"></simple-counter>
            <simple-counter :my-message="parentMsg" @update:my-message="val => parentMsg = val"></simple-counter> 
            <simple-counter my-message="Counter number 3"></simple-counter>
        </div>

        <div id="app-2">
            <p>{{ total }}</p>
            <button-counter v-on:increment="incrementTotal"></button-counter>
            <button-counter v-on:increment="incrementTotal"></button-counter>
        </div>

        <div id="app-3">
            <p>{{ something }}</p>
            <input v-model="something">
            <input v-bind:value="something" v-on:input="something = $event.target.value">
            <custom-input :value="something" @input="value => { something = value }"></custom-input>
        </div>

        <div id="app-4">
            <p>{{ price }}</p>
            <currency-input v-model="price"></currency-input>
        </div>
        
        <div id="app-5">
            <currency-sum label="Price" v-model="price"></currency-sum>
            <currency-sum label="Shipping" v-model="shipping"></currency-sum>
            <currency-sum label="Handling" v-model="handling"></currency-sum>
            <currency-sum label="Discount" v-model="discount"></currency-sum>
            <p>Total is: ${{ total }}</p>
        </div>

        <div id="app-6">
            <my-checkbox v-model="foo" value="some value"></my-checkbox>
        </div>

        <script src="https://unpkg.com/vue"></script>
        <script src="https://unpkg.com/vue-resource"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
        <script src="https://unpkg.com/lodash"></script><script src="https://cdn.rawgit.com/chrisvfritz/5f0a639590d6e648933416f90ba7ae4e/raw/974aa47f8f9c5361c5233bd56be37db8ed765a09/currency-validator.js"></script>
        <script>
            
            var data = { counter: 0 };

            Vue.component('simple-counter', {
                template: '<div><p v-if="normalized">{{ normalized }}</p><button v-on:click="counter += 1">{{ counter }}</button><button v-on:click="changeParentMessage">Change parent message</button></div>',
                data: function() {
                    // return data;
                    return {
                        counter: 0
                    }
                },
                props: ['myMessage'],
                computed: {
                    normalized: function() {
                        return this.myMessage ? this.myMessage.trim().toUpperCase() : '';
                    }
                },
                methods: {
                    changeParentMessage: function() {
                        this.$emit('update:myMessage', 'CHANGED!!!');
                    }
                }
            });

            Vue.component('example', {
                props: {
                    propA: Number,
                    propB: [String, Number],
                    propC: {
                        type: String,
                        required: true
                    },
                    propD: {
                        type: Number,
                        required: true
                    },
                    propE: {
                        type: Object,
                        default: function() {
                            return { message: 'hello' }
                        }
                    },
                    propF: {
                        validator: function(value) {
                            return value > 10
                        }
                    }
                }
            });

            Vue.component('button-counter', {
                template: '<button v-on:click="incrementCounter">{{ counter }}</button>',
                data: function() {
                    return {
                        counter: 0
                    }
                },
                methods: {
                    incrementCounter: function() {
                        this.counter += 1;
                        this.$emit('increment');
                    }
                }
            });

            Vue.component('custom-input', {
                template: '<input :value="value" v-on:input="changeValue" />',
                props: ['value'],
                methods: {
                    changeValue: function(e) {
                        this.$emit('input', e.target.value);
                    }
                }
            });

            Vue.component('currency-input', {
                template: '$<input ref="input" v-bind:value="value" v-on:input="updateValue($event.target.value)">',
                props: ['value'],
                methods: {
                    updateValue: function(value) {
                        var formattedValue = value.trim().slice(0, value.indexOf('.') === -1 ? value.length : value.indexOf('.') + 3);
                        if (formattedValue !== value) {
                            this.$refs.input.value = formattedValue;
                        }
                        this.$emit('input', Number(formattedValue));
                    }
                }
            });

            Vue.component('currency-sum', {
                template: '<div><label v-if="label">{{ label }}</label> <input ref="input" v-bind:value="value" v-on:input="updateValue($event.target.value)" v-on:focus="selectAll" v-on:blur="formatValue"></div>',
                props: {
                    value: {
                        type: Number,
                        default: 0
                    },
                    label: {
                        type: String,
                        default: ''
                    }
                },
                mounted: function() {
                    this.formatValue();
                },
                methods: {
                    updateValue: function(value) {
                        var result = currencyValidator.parse(value, this.value)
                        if (result.warning) {
                            this.$refs.input.value = result.value;
                        }
                        this.$emit('input', result.value);
                    },
                    formatValue: function() {
                        this.$refs.input.value = currencyValidator.format(this.value);
                    },
                    selectAll: function(event) {
                        setTimeout(function(event) {
                            event.target.select();
                        }, 0);
                    }
                }
            });

            Vue.component('my-checkbox', {
                model: {
                    prop: 'checked',
                    event: 'change'
                },
                props: {
                    checked: Boolean,
                    value: String
                }
            })

            var app = new Vue({
                el: '#app',
                data: {
                    parentMsg: ''
                },
                methods: {
                    doTheThing: function() {
                        console.log('doTheThing is invoked')
                    }
                }
            });

            var app2 = new Vue({
                el: '#app-2',
                data: {
                    total: 0
                },
                methods: {
                    incrementTotal: function() {
                        this.total += 1;
                    }
                }
            });

            var app3 = new Vue({
                el: '#app-3',
                data: {
                    something: ''
                }
            });

            var app4 = new Vue({
                el: '#app-4',
                data: {
                    price: '22'
                }
            });

            var app5 = new Vue({
                el: '#app-5',
                data: {
                    price: 0,
                    shipping: 0,
                    handling: 0,
                    discount: 0
                },
                computed: {
                    total: function() {
                        return (this.price * 100 + this.shipping * 100 + this.handling * 100 - this.discount * 100).toFixed(2);
                    }
                }  
            })

        </script>
    </body>
</html>
