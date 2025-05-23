import { defineStore } from 'pinia';

export const useTaxaServiceLocation = defineStore('taxa', {
    state: () => ({
        cidade: '',
        taxa: 0,
        trocoPara: 0,
        casa: '',
        rua: '',
        address: '',
        reference: '',
        phone: '',
    }),
    actions: {
        setCidadeETaxa(cidade, taxa, trocoPara = 0) {
            this.cidade = cidade;
            this.taxa = taxa;
            this.trocoPara = trocoPara;
        },
        setEndereco({ casa, rua, address, reference, phone }) {
            this.casa = casa;
            this.rua = rua;
            this.address = address;
            this.reference = reference;
            this.phone = phone; 
        },
        reset() {
            this.cidade = '';
            this.taxa = 0;
            this.trocoPara = 0;
            this.casa = '';
            this.rua = '';
            this.address = '';
            this.reference = '';
            this.phone = ''; 
        }
    }
});