<template>
    <div v-if="hasProducts">
        <div class="flex flex-col sm:flex-row justify-center items-center gap-3">
            <!-- Local de Retirada -->
            <div class="w-full md:w-1/2">
                <label for="pickup_location">Local de Retirada<span class="text-[red]">*</span></label>
                <select id="pickup_location" v-model="pickUpLocation" required>
                    <option value="" disabled>Selecione o local de retirada do produto</option>
                    <option v-for="location in locations" :key="location.value" :value="location.value" :disabled="location.disabled">
                        {{ location.label }}             
                    </option>
                </select>
            </div>

            <!-- Localidade -->
            <div class="w-full md:w-1/2">
                <label 
                for="location_name" 
                :style="{ color: pickUpLocation === 'store' ? '#e5e7eb' : '', cursor: pickUpLocation === 'store' ? 'not-allowed' : 'default' }"
                >
                Localidade para Entrega<span class="text-[red]"
                :style="{ color: pickUpLocation === 'store' ? '#e5e7eb' : '', cursor: pickUpLocation === 'store' ? 'not-allowed' : 'default' }">*</span>
                </label>

                <select id="location_name" v-model="selectedLocalidade" :disabled="pickUpLocation === 'store'"
                :style="{ cursor: pickUpLocation === 'store' ? 'not-allowed' : 'default' }" required>
                    <option value="" disabled>Selecione a localidade para entrega</option>
                    <option v-for="location in validLocalidades" :key="location" :value="location">
                        {{ location }}
                    </option>
                </select>
            </div>
        </div>

        <div v-if="pickUpLocation === 'delivery'" class="row">
            <!-- Endereço (mostra após seleção de localidade válida) -->
            <div v-if="selectedLocalidade" class="row mt-4 flex-col">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-6">
                        <label for="address">Endereço<span class="text-[red]">*</span></label>
                        <input id="address" type="text" v-model="address" placeholder="Endereço" class="w-full p-2 border rounded-md bg-white">
                    </div>
                    <div class="md:col-span-4">
                        <label for="localidade">Localidade<span class="text-[red]">*</span></label>
                        <input id="localidade" type="text" v-model="localidade" readonly class="w-full p-2 border rounded-md bg-gray-100">
                    </div>
                    <div class="md:col-span-2">
                        <label for="casa">Número<span class="text-[red]">*</span></label>
                        <input id="casa" type="text" v-model="casa" placeholder="Nº" class="w-full p-2 border rounded-md bg-white">
                    </div>            
                </div>


                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                    <div>
                        <label for="distrito">Distrito<span class="text-[red]">*</span></label>
                        <input id="distrito" type="text" v-model="distrito" placeholder="Distrito" class="w-full p-2 border rounded-md bg-white">
                    </div>
                    <div>
                        <label for="concelho">Concelho<span class="text-[red]">*</span></label>
                        <input id="concelho" type="text" v-model="concelho" placeholder="Concelho" class="w-full p-2 border rounded-md bg-white">
                    </div>
                    <div>
                        <label for="designacao_postal">Designação Postal<span class="text-[red]">*</span></label>
                        <input id="designacao_postal" type="text" v-model="designacaoPostal" placeholder="Designação Postal" class="w-full p-2 border rounded-md bg-white">
                    </div>
                    <div>
                        <label for="phone">Telefone<span class="text-[red]">*</span></label>
                        <input id="phone" type="text" v-model="phone" placeholder="Ex: 912345678" class="w-full p-2 border rounded-md bg-white" maxlength="9" @input="maskPhonePT">
                        <p v-if="phoneError" class="text-red-600 text-xs mt-1">{{ phoneError }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="ref">Referência</label>
                    <textarea id="ref" v-model="reference" placeholder="Referência" class="w-full p-2 border rounded-md h-24 resize-none bg-white"></textarea>
                </div>
            </div>

            <!-- Forma de Pagamento (só aparece se tudo estiver preenchido) -->
            <div v-if="showPaymentSection" class="row flex flex-col mt-6">
                <label>Forma de Pagamento</label>
                <div class="flex flex-wrap gap-4 mt-2">
                    <div 
                        v-for="method in paymentMethods" 
                        :key="method.value" 
                        class="border p-4 rounded-lg cursor-pointer flex flex-col items-center w-32 hover:shadow-md transition"
                        :class="{ 'ring-2 ring-[#031d40]': paymentMethod === method.value }"
                        @click="paymentMethod = method.value"
                    >
                        <img loading="lazy" :src="method.image" :alt="method.label" class="w-[50px] h-[50px] object-contain mb-2" />
                        <span class="text-center text-sm font-medium">{{ method.label }}</span>
                    </div>
                </div>

                <div class="row flex flex-col">
                    <div v-if="paymentMethod === 'money'" class="row flex flex-row w-full mt-4 !mb-0">
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

                    <div v-if="paymentMethod === 'money' && change === 'yes'" class="flex flex-row w-[290px] mt-0">
                        <div class="troco">
                            <label for="trocoPara">Troco para<span class="text-[red]">*</span></label>
                            <p v-if="paymentMethod === 'money' && change === 'yes' && trocoPara && !trocoValido" class="text-red-600 text-[0.75rem] mb-1">
                                O valor para troco deve ser maior ao total do pedido.
                            </p>

                            <input
                                id="trocoPara"
                                type="number"
                                v-model="trocoPara"
                                placeholder="Ex: 100"
                                class="w-full p-2 border rounded-md bg-white"
                                required
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4" v-if="canSubmit">
            <button type="button" @click="submitOrder" :disabled="!canSubmit">Confirmar Pedido</button>
        </div>
    </div>
    <div v-else class="flex flex-col items-center justify-center text-center gap-3 py-5 px-0">
        <div class=" w-full flex flex-col items-center justify-center text-center py-3 border border-[#CF1E0C] bg-[#FFE5E5] text-[#CF1E0C] rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-[35px] w-[35px]" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.5H19M7 13l-2 4m0 0a1 1 0 102 0m10 0a1 1 0 102 0" />
            </svg>

            <h3 class="text-lg sm:text-xl font-semibold mb-1">Seu carrinho está vazio</h3>
            <p class="text-sm sm:text-base text-[#CF1E0C] mb-0 w-full">
                Explore nossos produtos e adicione ao carrinho para continuar.
            </p>
        </div>

        <button
            @click="goToProducts"
            class="bg-[#CF1E0C] hover:bg-red-700 text-white px-6 py-2 rounded text-sm sm:text-base transition">
            Ver produtos
        </button>
    </div>
</template>

<script setup>
    import { ref, onMounted, watch, computed } from 'vue';
    import { useCartStore } from '@/stores/cartStores';
    import { useTaxaServiceLocation } from '@/stores/taxaServiceLocation';
    import axios from 'axios';

    const taxaStore = useTaxaServiceLocation();
    const cartStore = useCartStore();
    const hasProducts = computed(() => cartStore.cart.length > 0);

    const validLocalidades = ref([]);
    const localidadesComTaxa = ref([]);

    const getServiceLocations = async () => {
        try {
            const response = await axios.get('/api/locais-de-atendimentos');

        // Preencher validLocalidades só com os nomes dos locais ativos, por exemplo
        validLocalidades.value = response.data.map(loc => loc.name);
        localidadesComTaxa.value = response.data
        .filter(loc => loc.taxa)
        .map(loc => ({
            ...loc,
            valorTaxa: parseFloat(loc.taxa.valor)
        }));

        } catch (error) {
            console.error('Erro ao buscar os locais de atendimentos:', error);
        }
    };

    onMounted(() => {
        getServiceLocations();
    });

    const canSubmit = computed(() => {    
        // Retirada na loja: forma de pagamento deve estar escolhida
        if (pickUpLocation.value === 'store') {
            return true;
        }

        // Entrega ao domicílio: tudo precisa estar preenchido
        const entregaValida = address.value &&
            casa.value &&
            localidade.value &&
            distrito.value &&
            concelho.value &&
            designacaoPostal.value &&
            phone.value &&
            !phoneError.value;

        if (!entregaValida || !paymentMethod.value) {
            return false;
        }

        // Se for dinheiro, valida troco
        if (paymentMethod.value === 'money') {
            if (change.value === 'no') return true;
            if (change.value === 'yes' && trocoPara.value && trocoValido.value) return true;
            return false;
        }


        return true;
    });

    const pickUpLocation = ref('');
    const selectedLocalidade = ref('');
    const address = ref('');
    const casa = ref('');
    const localidade = ref('');
    const distrito = ref('');
    const concelho = ref('');
    const designacaoPostal = ref('');
    const phone = ref('');
    const phoneError = ref('');
    const reference = ref('');
    const paymentMethod = ref('');
    const trocoPara = ref('');
    const change = ref('');
    const showPaymentSection = ref(false);


    watch(pickUpLocation, (newValue) => {
        if (newValue === 'store') {
            casa.value = '';
            address.value = '';
            localidade.value = '';
            distrito.value = '';
            concelho.value = '';
            designacaoPostal.value = '';
            phone.value = '';
            reference.value = '';
            selectedLocalidade.value = '';

            paymentMethod.value = '';
            trocoPara.value = '';
            change.value = '';
        }
    });

    const locations = ref([
        { value: 'delivery', label: 'Entrega ao domicílio', disabled: false },
        { value: 'store', label: 'Retirar na loja', disabled: false },
    ]);

    const paymentMethods = ref([
        { value: 'mbway', label: 'Mbway', image: 'build/client/images/mbway.png' },
        { value: 'multibank', label: 'Multibanco', image: 'build/client/images/credit-debit.svg' },
        { value: 'money', label: 'Dinheiro', image: 'build/client/images/money.svg' },
    ]);

    const goToProducts = () => {
        window.location.href = '/produtos/';
    };

    // Atualiza campo localidade automaticamente se selecionada for válida
    const taxa = computed(() => {
    const local = localidadesComTaxa.value.find(loc => loc.name === selectedLocalidade.value);
    return local ? local.valorTaxa : 0;
    });

    const trocoCalculado = computed(() => {
        if (paymentMethod.value === 'money' && change.value === 'yes') {
            const valorTroco = parseFloat(trocoPara.value || 0);
            const totalPedido = cartStore.cart.reduce((total, item) => total + (item.price * item.quantity), 0) + taxa.value;

            const troco = valorTroco - totalPedido;
            return troco > 0 ? troco : 0;
        }
        return 0;
    });

    const trocoValido = computed(() => {
        if (paymentMethod.value === 'money' && change.value === 'yes') {
            const valorTroco = parseFloat(trocoPara.value || 0);
            const totalPedido = cartStore.cart.reduce((total, item) => total + (item.price * item.quantity), 0) + taxa.value;
            return valorTroco >= totalPedido;
        }
        return true; // se não for dinheiro ou não for 'yes', está válido por padrão
    });


    watch(trocoCalculado, (novoTroco) => {
        taxaStore.setCidadeETaxa(taxaStore.cidade, taxaStore.taxa, novoTroco);
    });

    watch(selectedLocalidade, (novaLocalidade) => {
        if (!novaLocalidade) {
            taxaStore.reset();
            return;
        }

        const localidadeObj = localidadesComTaxa.value.find(loc => loc.name === novaLocalidade);
        if (localidadeObj) {
            taxaStore.setCidadeETaxa(localidadeObj.name, localidadeObj.valorTaxa);
            localidade.value = localidadeObj.name;
        }
    });

    // Verifica se pode mostrar a forma de pagamento
    watch([address, casa, localidade, distrito, concelho, designacaoPostal, phone], () => {
        if (
            address.value &&
            casa.value &&
            localidade.value &&
            distrito.value &&
            concelho.value &&
            designacaoPostal.value &&
            phone.value
        ) {
            showPaymentSection.value = true;
        } else {
            showPaymentSection.value = false;
        }
    });

    watch(
        [address, casa, phone],
        ([newAddress, newCasa, newPhone]) => {
            taxaStore.setEndereco({
            address: newAddress,
            casa: newCasa,
            phone: newPhone,
            reference: taxaStore.reference,
            })
        }
    )

    watch(change, (newValue) => {
        if (newValue === 'no') {
            trocoPara.value = '';
            taxaStore.setCidadeETaxa(taxaStore.cidade, taxaStore.taxa, 0); // reseta o troco no store também
        }
    });

    function maskPhonePT(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não for número
        if (value.length > 9) value = value.slice(0, 9);
        phone.value = value;
    }

    watch(phone, (newVal) => {
        // Validação: 9 dígitos, começa com 2 ou 9
        if (!newVal) {
            phoneError.value = '';
            return;
        }
        if (!/^([29])\d{8}$/.test(newVal)) {
            phoneError.value = 'Telefone deve ter 9 dígitos e começar por 2 ou 9 (ex: 912345678)';
        } else {
            phoneError.value = '';
        }
    });

    async function submitOrder() {
        // 1. Montar mensagem do pedido com ícones
        const produtos = cartStore.cart.map(item => `🍣 ${item.title}, *Qtd*: ${item.quantity} unidade(s)`).join('%0A');
        // Local de retirada
        const retirada = `${pickUpLocation.value === 'store' ? '🏪 *Local de Retirada*: Retirar na loja' : '🛵 *Local de Retirada*: Entrega ao domicílio'}`;
        // Endereço: só mostra se todos os campos obrigatórios estiverem preenchidos
        let endereco = '';
        if (address.value && casa.value && localidade.value) {
            endereco = `📍 *Endereço*: ${address.value}, *Nº*: ${casa.value} - ${localidade.value}`;
        }
        let pagamento = '';
        if(pickUpLocation.value === 'delivery'){
            pagamento = `💳 *Forma de Pagamento*: ${paymentMethod.value === 'mbway' ? 'Mbway' : paymentMethod.value === 'multibanco' ? 'Multibanco' : 'Dinheiro'}`;
        }
        const telefone = phone.value ? `📞 *Telefone*: ${phone.value}` : '';
        const referencia = reference.value ? `📝 *Referência*: ${reference.value}` : '';
        let troco = '';
        if (paymentMethod.value === 'money') {
            if (change.value === 'yes') {
                troco = `💶 *Valor de troco*: €${(parseFloat(trocoPara.value) - (cartStore.cart.reduce((total, item) => total + (item.price * item.quantity), 0) + taxa.value)).toFixed(2)} | 💵 *Troco para*: €${trocoPara.value}`;
            } else {
                troco = '💶 *Valor de troco*: Não haverá troco';
            }
        }
        const total = cartStore.cart.reduce((total, item) => total + (item.price * item.quantity), 0) + taxa.value;
        const totalStr = `🧾 *Total do pedido*: €${total.toFixed(2)}`;

        // Ajuste de espaçamento para retirada na loja
        let mensagem = '';
        // Sempre mostra a forma de pagamento, independente do local
        let pagamentoMsg = '';
        if (paymentMethod.value) {
            if (paymentMethod.value === 'mbway') {
                pagamentoMsg = '💳 *Forma de Pagamento*: Mbway';
            } else if (paymentMethod.value === 'multibank') {
                pagamentoMsg = '💳 *Forma de Pagamento*: Multibanco';
            } else {
                pagamentoMsg = '💳 *Forma de Pagamento*: Dinheiro';
            }
        }
        if (pickUpLocation.value === 'store') {
            mensagem = `*Novo pedido*:%0A%0A*Produto(s)*:%0A%0A${produtos}%0A%0A${retirada}%0A${pagamentoMsg ? pagamentoMsg + '%0A' : ''}${totalStr}`;
        } else {
            mensagem = `*Novo pedido*:%0A%0A*Produto(s)*:%0A%0A${produtos}%0A%0A${retirada}%0A${endereco ? endereco + '%0A' : ''}${telefone}%0A${pagamentoMsg}%0A${troco}%0A${referencia}%0A${totalStr}`;
        }
        const numeroWhatsapp = '351930531500'; // Altere para o número desejado
        const urlWhatsapp = `https://wa.me/${numeroWhatsapp}?text=${mensagem}`;

        // 2. Abrir WhatsApp Web
        window.open(urlWhatsapp, '_blank');

        // 3. Decrementar estoque dos produtos
        try {
            await axios.post('/api/decrementar-estoque', {
                produtos: cartStore.cart.map(item => ({ id: item.id, quantity: item.quantity }))
            });
        } catch (e) {
            console.error('Erro ao decrementar estoque:', e);
        }

        // 4. Limpar carrinho
        cartStore.cart = [];
        localStorage.removeItem('cart');
        // Limpar taxa, troco e endereço na store
        taxaStore.setCidadeETaxa('', 0, 0);
        taxaStore.setEndereco({ address: '', casa: '', phone: '', reference: '' });
        // Limpar trocoPara explicitamente
        taxaStore.trocoPara = 0;
        // 5. Refresh na página
        setTimeout(() => {
            window.location.reload();
        }, 500);
    }

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