<template>
   <div>
       <li id="messageStyle" class="list-group-item" :class="className"><slot></slot>
       <span id="time">{{ time }}</span></li>
       <small class="badge float-right" :class="badgeClass">{{ user }}</small>
   </div>
</template>

<script>
    export default {
        props:[
            'color',
            'user',
            'time',
        ],

        computed:{
            className()
            {
                return 'list-group-item-'+this.color;
            },

            badgeClass()
            {
                return 'badge-'+this.color;
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
#time{
    margin-top:10px;
    color:black;
    font-size:12px;
}
#messageStyle{
    font-size:19px;
}
</style>
