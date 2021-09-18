<template>
    <div class="modal fade" id="ModalConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="ModalLabel">Aviso</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas mb-2 text-gradient" :class="options.iconClass" style="font-size: 18px;"></i><br>
                    <div class="mensaje">
                        ¿<span>{{ options.message }}</span>
                        <span class='font-weight-bold' v-if="data.name">{{ data.name }}<span v-if="data.surnames">{{ ' ' + data.surnames }}</span></span>
                        <span class='font-weight-bold' v-if="data.person">{{ data.person.name }}<span v-if="data.person">{{ ' ' + data.person.surnames }}</span></span>?
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <button type="button" class="btn btn-default me-2" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn" :class="options.btnClass" @click="confirm">{{ options.btnText }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['options', 'data', 'reload', 'showNotification'],

        methods: {
            confirm() {
                axios.post(this.route(this.options.url, this.data.id), {
                    '_method': 'PUT'
                })
                .then(response => {
                    this.closeModalConfirm();
                    this.reload();
                    this.showNotification(response.data.message, response.data.type);
                })
            },
            closeModalConfirm() {
                var ModalConfirm = document.getElementById('ModalConfirm')
                var modal = bootstrap.Modal.getInstance(ModalConfirm)
                modal.hide();
            }
        }
    }
</script>