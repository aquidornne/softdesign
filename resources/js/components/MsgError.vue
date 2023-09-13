<template>
    <div></div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    export default {
        name: "MsgError",
        computed: {
            ...mapGetters("msgErro", ['getErrorMsg', 'getTxtErrorMsg'])
        },
        data () {
            return {         
            } 
        },
        watch: {
            getErrorMsg: function(val) {
                if (val) {
                    this.message();
                    this.destroy();
                }
            }
        },
        methods: {
            ...mapActions('msgError', {showErrorMsg:'showErrorMsg', destroy: 'destroy'}),
            message() {
                this.$swal("Erro", this.getTxtErrorMsg, "error");
            }
        }
}
</script>