<template>
    <a style="font-size: 12px;" href="">
        <span v-html="unread.data.message"></span>
        <br>
        <small class="text-right">{{unread.data.thread.created_at}}</small>
    </a>
</template>

<script>
    export default {
        props:['unread'],
        data(){
            return {
                threadUrl:""
            }
        },
        mounted(){
            console.log(this.unread.data.message);
            console.log(this.unread.data.test);
            console.log(this.unread.data.user.name);
        }
    }
</script>