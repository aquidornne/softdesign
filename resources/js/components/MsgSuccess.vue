<template>
    <div></div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    export default {
        name: "MsgSuccess",
        computed: {
            ...mapGetters("msgSuccess", ['getSuccessMsg', 'getTxtSuccessMsg'])
        },
        data () {
            return {         
            } 
        },
        watch: {
            getSuccessMsg: function(val) {
                if (val) {
                    this.message();
                    this.destroy();
                }
            }
        },
        methods: {
            ...mapActions('msgSuccess', {showSuccessMsg:'showSuccessMsg', destroy: 'destroy'}),
            message() {
                this.$swal("Sucesso", this.getTxtSuccessMsg, "success");
            }
        }
}
</script>