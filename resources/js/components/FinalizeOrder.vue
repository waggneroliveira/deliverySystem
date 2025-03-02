<template>
    <form @submit.prevent="submitForm">
        <div class="row">
            <div class="pick-up-location">
                <label for="pick_up_location">Local de Retirada</label>
                <select id="pick_up_location" v-model="pickUpLocation" required>
                    <option value="" disabled>Selecione local de retirada</option>
                    <option 
                        v-for="location in locations" 
                        :key="location.value" 
                        :value="location.value" 
                        :disabled="location.disabled"
                    >
                        {{ location.label }}
                    </option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="postal-code">
                <label for="postal_code">Código Postal</label>
                <input 
                    id="postal_code" 
                    type="text" 
                    v-model="postalCode" 
                    placeholder="Ex: 1000-001" 
                    @input="formatPostalCode"
                    maxlength="8"
                    required
                >

            </div>
        </div>

        <div v-if="showAddressFields" class="row mt-2 flex-col">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="address">
                    <label for="address">Endereço</label>
                    <input id="address" type="text" v-model="address" placeholder="Endereço" class="w-full p-2 border rounded-md bg-gray-100" readonly>
                </div>
                <div class="address">
                    <label for="rua">Rua</label>
                    <input id="rua" type="text" v-model="rua" placeholder="Rua" class="w-full p-2 border rounded-md bg-gray-100" readonly>
                </div>
                <div class="house">
                    <label for="casa">Número</label>
                    <input id="casa" type="text" v-model="casa" placeholder="Número" class="w-full p-2 border rounded-md bg-gray-100" readonly>
                </div>
                <div class="localidade">
                    <label for="localidade">Localidade</label>
                    <input id="localidade" type="text" v-model="localidade" placeholder="Localidade" class="w-full p-2 border rounded-md bg-gray-100" readonly>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                <div class="distrito">
                    <label for="distrito">Distrito</label>
                    <input id="distrito" type="text" v-model="distrito" placeholder="Distrito" class="w-full p-2 border rounded-md bg-gray-100" readonly>
                </div>
                <div class="concelho">
                    <label for="concelho">Concelho</label>
                    <input id="concelho" type="text" v-model="concelho" placeholder="Concelho" class="w-full p-2 border rounded-md bg-gray-100" readonly>
                </div>
                <div class="designacao-postal">
                    <label for="designacao_postal">Designação Postal</label>
                    <input id="designacao_postal" type="text" v-model="designacaoPostal" placeholder="Designação Postal" class="w-full p-2 border rounded-md bg-gray-100" readonly>
                </div>
                <div class="phone">
                    <label for="phone">Telefone</label>
                    <input id="phone" type="number" v-model="phone" placeholder="Telefone" class="w-full p-2 border rounded-md">
                </div>
            </div>

            <div class="mt-4">
                <label for="ref">Referência</label>
                <textarea id="ref" v-model="reference" placeholder="Referência" class="w-full p-2 border rounded-md h-24 resize-none"></textarea>
            </div>
        </div>

        <div v-if="showAddressFields" class="row">
            <label>Forma de Pagamento</label>
            <div class="payments">
                <div 
                    v-for="method in paymentMethods" 
                    :key="method.value" 
                    class="payment-box"
                    :class="{ active: paymentMethod === method.value }"
                    @click="paymentMethod = method.value"
                >
                    <img :src="method.image" :alt="method.label">
                    <span>{{ method.label }}</span>
                </div>
            </div>
        </div>

        <div v-if="paymentMethod === 'money'" class="row !flex-row">
            <h5>Precisa de troco?</h5>
            <div class="change">
                <input id="change_yes" type="radio" v-model="change" value="yes" class="!h-[18px] sm:h-[35px]">
                <label for="change_yes" class="text-[0.75rem] sm:text-[0.938rem]">Sim</label>
            </div>
            <div class="change">
                <input id="change_no" type="radio" v-model="change" value="no" class="!h-[18px] sm:h-[35px]">
                <label for="change_no" class="text-[0.75rem] sm:text-[0.938rem]">Não</label>
            </div>
        </div>

        <div v-if="paymentMethod === 'money' && change === 'yes'" class="row">
            <div class="troco">
                <label for="trocoDe">Troco de</label>
                <input id="trocoDe" type="number" v-model="trocoDe" placeholder="Ex: 50€">
            </div>
            <div class="troco">
                <label for="trocoPara">Troco para</label>
                <input id="trocoPara" type="number" v-model="trocoPara" placeholder="Ex: 100€">
            </div>
        </div>

        <div v-if="showAddressFields" class="row">
            <button type="submit">Confirmar Pedido</button>
        </div>
    </form>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const locations = ref([
    { value: 'delivery', label: 'Entrega ao domicílio', disabled: false },
    // Adicionar lojas no futuro
]);

const formatPostalCode = () => {
    let value = postalCode.value.replace(/\D/g, ''); // Remove caracteres não numéricos

    if (value.length > 4) {
        value = value.slice(0, 4) + '-' + value.slice(4, 7);
    }

    postalCode.value = value;

    // Chama a API automaticamente ao atingir 8 caracteres válidos
    if (postalCode.value.length === 8) {
        handlePostalCode();
    } else {
        limparCampos(); // Limpa os campos se não for um CEP válido
    }
};


const pickUpLocation = ref('delivery');
const postalCode = ref('');
const address = ref('');
const localidade = ref('');
const rua = ref('');
const casa = ref('');
const distrito = ref('');
const concelho = ref('');
const designacaoPostal = ref('');
const phone = ref('');
const reference = ref('');
const paymentMethod = ref('');
const trocoDe = ref('');
const trocoPara = ref('');
const change = ref('');
const showAddressFields = ref(false);

const handlePostalCode = async () => {
    if (postalCode.value.length >= 7) {
        try {
            const response = await axios.post('/verify-postal-code', {
                postal_code: postalCode.value
            });

            console.log("Resposta da API:", response.data);

            if (response.data) {
                // Se existirem pontos, pega o primeiro (ou modificar para selecionar)
                const ponto = response.data.pontos?.[0] || {};

                rua.value = ponto.rua || 'Não disponível';
                casa.value = ponto.casa || 'Não disponível';
                address.value = `${response.data.designacao_postal}`;
                localidade.value = response.data.localidade;
                distrito.value = response.data.distrito;
                concelho.value = response.data.concelho;
                designacaoPostal.value = response.data.designacao_postal;

                showAddressFields.value = true;
            } else {
                limparCampos();
            }
        } catch (error) {
            console.error("Erro ao buscar o CEP:", error);
            limparCampos();
        }
    } else {
        limparCampos();
    }
};

// Função para limpar os campos ao digitar um CEP inválido
const limparCampos = () => {
    rua.value = '';
    casa.value = '';
    address.value = '';
    localidade.value = '';
    distrito.value = '';
    concelho.value = '';
    designacaoPostal.value = '';
    showAddressFields.value = false;
};

const paymentMethods = ref([
    { value: 'mbway', label: 'Mbway', image: 'build/client/images/mbway.png' },
    { value: 'credit', label: 'Crédito', image: 'build/client/images/credit-debit.svg' },
    { value: 'debit', label: 'Débito', image: 'build/client/images/credit-debit.svg' },
    { value: 'money', label: 'Dinheiro', image: 'build/client/images/money.svg' },
]);

const submitForm = () => {
    alert('Pedido confirmado!');
};
</script>


<style scoped>
/* Estilos gerais */
.row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Inputs estilizados */
input, select {
    width: 100%;
    height: 35px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

/* Alinhamento dos inputs */
.address, .phone, .ref {
    flex: 1;
}

/* Pagamentos estilizados */
.payments {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.payment-box {
    width: 120px;
    height: 80px;
    border: 2px solid #ddd;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-box img {
    width: 50px;
    height: 50px;
    object-fit: contain;
}

.payment-box span {
    font-size: 14px;
    font-weight: bold;
    margin-top: 5px;
}

/* Efeito ativo no pagamento selecionado */
.payment-box.active {
    border-color: #031d40;
    background: rgba(0, 123, 255, 0.1);
}

/* Estilos dos botões */
button {
    background: #CF1E0C;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s;
}

button:hover {
    background: rgba(185, 28, 28, 0.9);
}
.troco {
    flex: 1;
}
@media screen and (max-width: 871px) {
    .row {
        flex-direction: column;
    }
}
@media screen and (max-width: 422px) {
    .payments{
        justify-content: space-between;
        gap: 0;
    }
    .payment-box{
        width:48%;
        margin-bottom: 10px;
    }
}
</style>

