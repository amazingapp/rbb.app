<!DOCTYPE html>
<html>
<head>
    <title>Title</title>
</head>
<body>
        <!-- inside parent template -->
        <my-component>
            <input type="text" v-model="this.title" value="">
        </my-component>
        <div id="main">
            <ul>
                <li v-repeat="user in users">@{{user.name}}</li>
            </ul>
        </div>
        <script src="/js/vue.min.js"></script>
        <script src="/js/socket.js"></script>

        <script type="text/javascript">
            var MyComponent = Vue.extend({
            el:"body",
            template: '<p>A custom component!</p>',
            data: function () {
                return {
                  title: 'Hello!'
                }
              },
            methods :{
                getTitle: function(){
                    return this.title;
                }
            }
            });

            Vue.component('my-component', MyComponent);

            new Vue({
                el:"body",
                data:{

                }
            })

            // new Vue({
            //     el: "#main",
            //     data : {
            //         users: [
            //                     {
            //                         name: 'Rabina Singh',
            //                         employee_id: '11844'
            //                     }
            //                 ]
            //     },
            //     ready: function(){

            //             self = this;
            //             var socket = io('http://banijya.dev:6001');
            //             socket.on('employee_id:Banijya\\Events\\ReceivedNewMessage', function(message){
            //                 console.log(message.user);
            //                 self.users.push(message.user);
            //             });
            //     }
            // })
        </script>
</body>
</html>