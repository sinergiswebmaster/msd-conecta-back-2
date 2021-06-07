<template>
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chats</div>

                <div class="panel-body">
                    <chat-messages :messages="messages"></chat-messages>
                </div>
                <div class="panel-footer">
                   
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import ChatMessages from './components/ChatMessages.vue'
import ChatForm from './components/ChatMessages'
export default {
    name: "App",

    data() {
        return {
            messages:[{id:1, message:'Hola', user: { name:'Fernando' }}]
        }
    },
    created() {
        console.log('created', Echo.channel('chat'))

        Echo.channel('chat')
        .listen('MessageSent', (e) => {
            console.log('message', e)
        })
    },

    components: {
        ChatMessages,
        ChatForm
    }


}
</script>

<style lang="scss" scoped>

</style>