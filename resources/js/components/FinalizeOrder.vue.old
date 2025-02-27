<template>
    <form @submit.prevent="submitForm" class="w-full">
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
                    @input="handlePostalCode"
                    required
                >
            </div>
        </div>

        <div v-if="showAddressFields" class="row">
            <div class="address">
                <label for="address">Endereço</label>
                <input id="address" type="text" v-model="address" placeholder="Endereço" readonly>
            </div>
            <div class="phone">
                <label for="phone">Telefone</label>
                <input id="phone" type="text" v-model="phone" placeholder="Telefone">
            </div>
            <div class="ref">
                <label for="ref">Referência</label>
                <input id="ref" type="text" v-model="reference" placeholder="Referência">
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

        <div v-if="paymentMethod === 'money'" class="row">
            <h5>Precisa de troco?</h5>
            <div class="change">
                <input id="change_yes" type="radio" v-model="change" value="yes">
                <label for="change_yes">Sim</label>
            </div>
            <div class="change">
                <input id="change_no" type="radio" v-model="change" value="no">
                <label for="change_no">Não</label>
            </div>
        </div>

        <!-- Campos para troco aparecem se "Sim" for selecionado -->
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
import { ref, watch } from 'vue';

// Lista de locais de retirada
const locations = ref([
    { value: 'delivery', label: 'Entrega ao domicílio', disabled: false },
]);

const pickUpLocation = ref('delivery');
const postalCode = ref('');
const address = ref('');
const phone = ref('');
const reference = ref('');
const paymentMethod = ref('');
const trocoDe = ref('');
const trocoPara = ref('');
const change = ref('');
const showAddressFields = ref(false);

const paymentMethods = ref([
    { value: 'mbway', label: 'Mbway', image: 'build/client/images/mbway.png' },
    { value: 'credit', label: 'Crédito', image: 'build/client/images/credit-debit.svg' },
    { value: 'debit', label: 'Débito', image: 'build/client/images/credit-debit.svg' },
    { value: 'money', label: 'Dinheiro', image: 'build/client/images/money.svg' },
]);

// Função para buscar o endereço pelo código postal
const fetchAddressByPostalCode = async () => {
    if (!/^\d{4}-\d{3}$/.test(postalCode.value)) {
        showAddressFields.value = false;
        return;
    }

    console.log('Buscando endereço para o código postal:', postalCode.value);

    try {
        const response = await fetch(`https://api.allorigins.win/raw?url=https://json.geoapi.pt/cp/${postalCode.value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        console.log('Resposta da API:', response);

        if (!response.ok) throw new Error('Erro ao buscar endereço');

        const data = await response.json();

        console.log('Dados da API:', data);

        // Verificando se a API retornou os dados corretamente
        if (data && data.localidade) {
            // Se a localidade e o distrito forem encontrados
            address.value = `${data.localidade}, ${data.distrito}`;
            phone.value = data.telefone || ''; // Adicionando telefone se disponível
            reference.value = data.referencia || ''; // Adicionando referência se disponível
            showAddressFields.value = true;
        } else {
            address.value = 'Endereço não encontrado';
            phone.value = '';
            reference.value = '';
            showAddressFields.value = false;
        }
    } catch (error) {
        console.error('Erro ao buscar código postal:', error);
        address.value = 'Erro ao obter endereço';
        phone.value = '';
        reference.value = '';
        showAddressFields.value = false;
    }
};

// Monitorar mudanças no código postal e buscar endereço automaticamente
watch(postalCode, fetchAddressByPostalCode);

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
</style>
