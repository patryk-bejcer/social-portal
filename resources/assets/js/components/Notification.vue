<template>
    <li class="dropdown" @click="markNotificationAsRead">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <i class="fa fa-bell" style="margin-rigth:5px;"></i><span style="margin-left:5px;">Powiadomienia</span>
            <span class="badge alert-danger">{{unreadNotifications.length}}</span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <notification-item v-for="unread in unreadNotifications" :unread="unread"></notification-item>
            </li>

            <hr style="margin:0">
            <li><a href="/notifications"><small style="font-size: 10px;">Zobacz wszystkie powiadomienia</small></a></li>
        </ul>
    </li>
</template>

<script>
    import NotificationItem from './NotificationItem.vue';
    export default {
        props: ['unreads', 'userid'],
        components: {NotificationItem},
        data(){
            return {
                unreadNotifications: this.unreads
            }
        },
        methods: {
            markNotificationAsRead() {
                if (this.unreadNotifications.length) {
                    axios.get('/markAsRead');
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
            console.log(this.userid);
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {


                    console.log(notification);
                    
                    console.log(notification.message);
                    console.log(notification.user);
                    let newUnreadNotifications = {data: {thread: notification.thread, user: notification.user, message: notification.message, test:'testdane'}};
                    this.unreadNotifications.push(newUnreadNotifications);
                });
        }
    }
</script>