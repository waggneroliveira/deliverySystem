import { defineStore } from 'pinia';

export const useTaxaServiceLocation = defineStore('taxa', {
    state: () => ({
            cidade: '',
            taxa: 0,
    }),
    actions: {
        setCidadeETaxa(cidade, taxa) {
            this.cidade = cidade;
            this.taxa = taxa;
        },
        setTaxa(taxa) {
            this.taxa = taxa;
        },
        reset() {
            this.cidade = '';
            this.taxa = 0;
        }
    }

});