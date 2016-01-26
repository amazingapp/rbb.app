Vue.component('user-messages',{
 data: function () {
        return {
           user:{
                url: '',
                image: '',
                name: '',
                message:{
                  new:'',
                  time:''
                }
           },
            messages: [
                        {
                          user: "kabir",
                          user_url: 'http://facebook.com',
                          image: '',
                          time: "2015-01-04 12:12",
                          text:  "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod"
                        },
                        {
                          user: "Rabina",
                          time: "2015-01-04 12:12",
                          text:  "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod"
                        },
                        {
                          user: "kabir",
                          time: "2015-01-04 12:12",
                          text:  "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod"
                        },
                        {
                          user: "kabir",
                          time: "2015-01-04 12:12",
                          text:  "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod"
                        },
                        {
                          user: "kabir",
                          time: "2015-01-04 12:12",
                          text:  "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod"
                        },
                        {
                          user: "kabir",
                          time: "2015-01-04 12:12",
                          text:  "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod"
                        },
                        {
                          user: "kabir",
                          time: "2015-01-04 12:12",
                          text:  "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod"
                        },
                        {
                          user: "kabir",
                          time: "2015-01-04 12:12",
                          text:  "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod"
                        }
                      ]
          };
    },

    ready:function(){
        this.$on('new.message.sent',function(){
              this.scrollLatest();
          }.bind(this));
        this.scrollLatest();
    },

   methods: {
      sendMessage: function(e){
          var message = {
                user: "kabir",
                user_url: 'http://facebook.com',
                image: '',
                time: "2015-01-04 12:12",
                text:  this.user.message.new
          };

          this.messages.push(message);
          this.$emit('new.message.sent');
          this.user.message.new = '';
      },
      scrollLatest:function(){
        $(".chat").animate({scrollTop: $('li:last').offset().top + 1000});
      }
  }
});