# **Equal Learn Project**

## **Resumo Executivo**

<aside>
💡 O projeto proposto é o desenvolvimento de uma plataforma de interações entre pessoas, grupos e empresas. A plataforma permitirá a criação de cursos, colaborações, áreas para base de conhecimento, compartilhamento de experiências do usuário e ideias diversas.

</aside>

## **Visão Geral do Projeto**

<aside>
⚠️ A plataforma será desenvolvida para atender às necessidades de interações entre pessoas, grupos e empresas, com foco em educação e compartilhamento de conhecimentos. A plataforma permitirá que os usuários criem cursos, colaborem em projetos, compartilhem suas experiências e ideias, e acessem uma base de conhecimento para encontrar informações relevantes. A plataforma terá uma interface de usuário moderna e responsiva, com recursos avançados de pesquisa, integração com mídias sociais e recursos de colaboração em tempo real.

</aside>

## **Arquitetura do Sistema**

<aside>
⌨️ O sistema será desenvolvido seguindo uma arquitetura de três camadas: frontend, backend e banco de dados.

1. Frontend: O frontend será desenvolvido utilizando o React.js como framework JavaScript, com os compiladores CSS Less e Bootstrap5 para a criação da interface de usuário. O frontend será responsável pela apresentação dos dados e pela interação com o usuário, incluindo o gerenciamento de eventos, validação de entrada de dados e chamadas aos APIs do backend.
2. Backend: O backend será desenvolvido em PHP, que é uma linguagem de script amplamente utilizada para o desenvolvimento de aplicações web. Ele será responsável pelo processamento das requisições do frontend, autenticação e autorização de usuários, manipulação de dados e integração com APIs de terceiros, como a API de login do Google e a API de incorporação de vídeos do YouTube.
3. Banco de Dados: O banco de dados será desenvolvido utilizando o MySQL, que é um sistema de gerenciamento de banco de dados popular e amplamente utilizado. Ele será responsável pelo armazenamento dos dados da aplicação, como informações de usuários, cursos, projetos, experiências do usuário e ideias diversas, bem como as informações necessárias para a autenticação dos usuários, como tokens de acesso e permissões de acesso aos recursos da aplicação.
</aside>

## **Integrações com Terceiros**

<aside>
🧑‍💼 A plataforma terá integrações com terceiros para fornecer funcionalidades avançadas, como login com Google e upload de vídeos com incorporação de vídeos do YouTube. Para isso, serão utilizadas as seguintes APIs:

1. Google Login API: Esta API permitirá que os usuários façam login na plataforma utilizando suas contas do Google. Serão implementados mecanismos de autenticação e autorização para garantir a segurança do acesso aos recursos da aplicação.
2. YouTube API: Esta API permitirá que os usuários façam upload de vídeos para os cursos e projetos na plataforma, com a capacidade de incorporar vídeos do YouTube diretamente na aplicação. Serão implementadas funcionalidades de gerenciamento de vídeos, como upload, visualização e exclusão de vídeos.
</aside>

## **Modelo de Banco de Dados**

<aside>
 💾 O modelo de banco de dados será projetado para atender às necessidades de armazenamento e recuperação eficiente dos dados da aplicação. Serão utilizadas tabelas para representar as entidades principais do sistema, como usuários, cursos, projetos, experiências do usuário e ideias diversas. Serão estabelecidos relacionamentos entre as tabelas, utilizando chaves primárias e estrangeiras para garantir a integridade dos dados. Além disso, serão definidos índices e restrições de integridade para otimizar o desempenho do banco de dados.

</aside>

## **Principais Funcionalidades**

<aside>
📌 A plataforma terá as seguintes funcionalidades principais:

1. Criação de Cursos: Os usuários (universitários e empresas) poderão criar cursos sobre diversos temas, com a capacidade de adicionar conteúdos, como aulas, materiais de apoio, avaliações e recursos adicionais. Permitindo também a emissão de certificados após a conclusão.
2. Colaboração em Projetos: Os usuários poderão colaborar em projetos, com a capacidade de criar equipes, compartilhar documentos, trocar mensagens e gerenciar tarefas em tempo real.
3. Base de Conhecimento: A plataforma terá uma base de conhecimento, onde os usuários poderão encontrar informações relevantes, como tutoriais, artigos, dicas e melhores práticas.
4. Compartilhamento de Experiências do Usuário: Os usuários poderão compartilhar suas experiências, feedbacks e opiniões sobre cursos, projetos e outras atividades na plataforma.
5. Integração com Terceiros: A plataforma terá integrações com terceiros, como login com Google para autenticação dos usuários e upload de vídeos com incorporação de vídeos do YouTube para enriquecer os cursos e projetos.
</aside>

## **Plano Free**

### Paradigmas do Ambiente:

<aside>
💡 Regras de negocio:

1. O acesso será gratuito, usando um e-mail e senha para cadastro inicial.
2. Armazenaremos as seguintes informações sensíveis com o cadastro avançado (necessário para emissão de certificado): Nome completo, CPF, idade e endereço.
3. O acesso será dividido em Professor solidário (Universitários) e aluno.
4. Os cursos serão no formato de vídeo, divididos por matéria e tema e com matéria escrito como referencia.
5. 
</aside>

## **Plano Pago**