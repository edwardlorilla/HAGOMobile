<template>
    <tr>
        <td @click="$emit('chat', user)" >{{user.name}}</td>
        <td @click="$emit('chat', user)" >{{user.email}}</td>
        <td v-if="half">
            <div class="w3-bar">
                <button @click="$emit('edit', user)" class="w3-bar-item w3-button w3-teal">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
                <button @click="$emit('delete', user)"  class="w3-bar-item w3-button w3-red"><i class="fa fa-trash" aria-hidden="true"></i>
                </button>
                <button @click="$emit('chat', user)"  class="w3-bar-item w3-button w3-blue" >
                    <i class="fa fa-comments" aria-hidden="true"></i>
                </button>
            </div>
        </td>
    </tr>
</template>
<script>
    export default{
        props: {
            user: {
                type: Object
            },
            half:{
                type: Boolean
            }
        },
        data(){
            return {}
        },
    }
</script>
