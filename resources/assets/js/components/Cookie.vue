<template>
    <div>
        <div id="cookie">
            The Rad Elk is a citizen of the internet and he gets fed with cookies. Will you understand that this is how it works around here? 
            <br><br>
            <button @click="set">I accept cookies</button>
            <a href="cookies">Read more here</a>
        </div>
    </div>
</template>

<script>
    export default {
        props : {

        },
        data() {
            return {

            }
        },
        mounted() {

        },
        methods : {
            set() {
                let date = new Date();
                date.setTime(date.getTime() + (364*24*60*60*1000));
                window.document.cookie = 'cookie=1; expires=' + date + '; path=/';
                window.document.getElementById('cookiecomponent').remove();
            },
        },
    }
</script>

<style scoped>
#cookie{
    position: fixed;
    width:100%;
    bottom: 0;
    background-color: #ecf0f1;
    font-family: 'Montserrat', sans-serif;
    font-weight:400;
    z-index:99;
    text-align: center;
    padding:30px 0;
}
button, a{
    border:none;
    display: inline-block;
    padding: 15px;
    font-family: 'Montserrat', sans-serif;
    margin-left: 20px;
    color:#fff;
    cursor:pointer;
    font-size:1em !important;

}
button{
    background-color: #0984e3;    
}
a{
    background-color: #16a085;
}
    button:hover{
        background-color: #3498db;
    }
    a:hover{
        background-color: #1abc9c;
    }
</style>
