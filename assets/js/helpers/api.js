const ApiHelpers = (() => {
    function onlyDigits(value) {
        return (value || '').replace(/\D/g, '');
    }

    async function buscarCep(cep) {
        const clean = onlyDigits(cep);

        if (clean.length !== 8) {
            return { ok: false, error: 'CEP deve ter 8 dígitos.' };
        }

        try {
            const response = await fetch(`https://viacep.com.br/ws/${clean}/json/`);
            const data = await response.json();

            if (data.erro) {
                return { ok: false, error: 'CEP não encontrado.' };
            }

            return {
                ok: true,
                data: {
                    cep: data.cep,
                    endereco: data.logradouro || '',
                    bairro: data.bairro || '',
                    cidade: data.localidade || '',
                    uf: data.uf || '',
                    complemento: data.complemento || '',
                }
            };
        } catch (e) {
            return { ok: false, error: 'Falha ao consultar ViaCEP.' };
        }
    }

    async function buscarCnpj(cnpj) {
        const clean = onlyDigits(cnpj);

        if (clean.length !== 14) {
            return { ok: false, error: 'CNPJ deve ter 14 dígitos.' };
        }

        try {
            const response = await fetch(`https://brasilapi.com.br/api/cnpj/v1/${clean}`);

            if (!response.ok) {
                return { ok: false, error: 'CNPJ não encontrado.' };
            }

            const data = await response.json();

            return {
                ok: true,
                data: {
                    cnpj: data.cnpj,
                    razao_social: data.razao_social || '',
                    nome_fantasia: data.nome_fantasia || '',
                    cep: data.cep || '',
                    endereco: data.logradouro || '',
                    numero: data.numero || '',
                    bairro: data.bairro || '',
                    cidade: data.municipio || '',
                    uf: data.uf || '',
                }
            };
        } catch (e) {
            return { ok: false, error: 'Falha ao consultar BrasilAPI.' };
        }
    }

    return { buscarCep, buscarCnpj, onlyDigits };
})();
