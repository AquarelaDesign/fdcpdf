# fdcpdf
Geração de documentos em PDF baseados na Ficha do Carro (http://www.fichadocarro.com.br).

### Parâmetros

| Parâmetro     | Descrição                                                            | Padrão                                                            |
|---------------|----------------------------------------------------------------------|-------------------------------------------------------------------|
| **idgpas**    | Código Identificador da Passagem                                     | Obrigatório quando não for informado idusu ou email da empresa    |
| **idusu**     | Código Identificador da Empresa                                      | Obrigatório quando não for informado idgpas ou email da empresa   |
| **email**     | Email da Empresa                                                     | Obrigatório quando não for informado idgpas ou idusu da empresa   |
| **idipas**    | Codigo da Passagem                                                   | Opcional quando informado parametros de filtro                    |
| **logo**      | Imagem da Logomarca Previamente enviada                              | Informado se a imagem já se encontrar no servidor                 |
| **di**        | Data da Passagem Incial                                              | Data Inicial para Filtro de Pesquisa                              |
| **df**        | Data da Passagem Final                                               | Data Final para Filtro de Pesquisa                                |
| **pi**        | Passagem Incial                                                      | Passagem/Orçamento Inicial para Filtro de Pesquisa                |
| **pf**        | Passagem Final                                                       | Passagem/Orçamento Final para Filtro de Pesquisa                  |
| **q**         | Quantidade de Registros                                              | Quantidade de Registros que será retornado quando aplicado filtro |
| **v**         | view Formato que será apresentado PDF/HTML                           | Padrão PDF                                                        |
| **m**         | modo de visualizacao do PDF - [W] fullwidth, [F] fullpage            | Padrão 'fullpage'                                                 |
| **e**         | Envia Email [S] Sim (Mostra e Envia) / [E] Envia / '' Somente Mostra | Padrão Somente Mostra                                             |
| **tipo**      | Tipo de Documento [OrcPas] Orçamento / Passagem                      | Padrão 'OrcPas'                                                   |
| **dev**       | Modo desenvolvimento [D] Desenvolvimento / [''] Produção             | Padrão '' Produção                                                |


### Exemplo de chamada

#### Básica

    http://fdc.procyon.com.br/wss/fdcpdf/impRel.php?idgpas=665441

#### Mostra o PDF e encaminha como anexo para o e-mail do cliente

    http://fdc.procyon.com.br/wss/fdcpdf/impRel.php?idgpas=665441&e=S

