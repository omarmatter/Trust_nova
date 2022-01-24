<style xmlns="http://www.w3.org/1999/html">
.container {
    border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
}

/* Darker chat container */
.darker {
    border-color: #ccc;
    background-color: #ddd;
}

/* Clear floats */
.container::after {
    content: "";
    clear: both;
    display: table;
}

/* Style images */
.container img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
}

/* Style the right image */
.container img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
}

/* Style time text */
.time-right {
    float: right;
    color: #aaa;
}

/* Style time text */
.time-left {
    float: left;
    color: #999;
}
</style>

<template>

  <div class="card mb-6 py-3 px-6">

      <div id="replies">

          <div v-for="(reply , index) in replies"  class="container" >

              <img src="https://www.drpaulcohen.com/wp-content/uploads/2016/11/no-photo.jpg" alt="Avatar" class="right">
              <p v-html="reply.message"></p>

          </div>
      </div>


          <input type="text" class="form-control" style="border: 1px solid green"  v-model="message">
      <button class="btn btn-default bg-primary" @click="addSend()">Send</button>

  </div>

</template>

<script>
export default {
    props: ['resourceName', 'resourceId', 'panel'],
    data() {
        return {
            replies: [],
            id:'',
            message :''

        }
    },
    mounted() {
        console.log(this.panel.fields[0].ticket)
        this.id= this.panel.fields[0].ticket.id
        this.replies=this.panel.fields[0].replies
    },
    methods: {

        addSend() {
            let message = {
                message: this.message

            }
            axios.post(`/nova-vendor/chatticket/storeReply/${this.id}`,message)
                .then(response => {
                    this.replies.push(response.data.data)
            });
        }

    },

}
</script>
