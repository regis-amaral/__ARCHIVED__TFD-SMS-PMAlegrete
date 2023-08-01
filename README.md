# __ARCHIVED__TFD-SMS-PMAlegrete

Sistema para controle do setor de Tratamento Fora Domicílio da Secretaria Municipal de Saúde - Prefeitura Municipal de Alegrete.

```
docker build -t server-tfd . 
docker run -d -p 80:80 --name server-tfd server-tfd
```

<p align="justify">     Esse foi o primeiro sistema que desenvolvi, então se for olhar os códigos da pasta src não espere grandes sacadas. Eu mesmo quando olho para eles fico abismado com o tanto de lógica confusa e falhas de segurança que se quer tive a preocupação de tratar naquela época. Para minha sorte, o sistema rodava apenas na intranet e era restrito a computadores específicos através de um servidor proxy com Squid. Nesta época, eu tinha somente a formação de Técnico de TI e tive que estudar por conta própria pois não sabia nada de programação. Decidi colocar ele no GitHub para contar um pouco de minha história...</p>


## Senta que lá vem a história!

<p align="justify">  O ano era 2008, não lembro exatamente quando foi o fatídico dia ou o mês. Meu chefe havia acabado de me pedir para criar uma mala direta no computador do setor de Tratamento Fora Domicílio e ensinar a atendente a usá-la. Ao chegar no setor, me deparei com uma colega absurdamente agitada, estressada pela quantidade de pessoas que aguardavam atendimento e pela grande quantidade de tarefas atrasadas. Entre o atendimento de um paciente e outro, fui perguntando sobre o processo de trabalho do setor e como poderia ajudá-la. Para minha surpresa, descobri que para cada paciente encaminhado para tratamento em outras cidades fora de Alegrete, ela criava 4 ou mais documentos que ficavam espalhados em vários locais do velho PC com Windows XP. Ao ver aquela enorme quantidade de pastas e documentos com nomes de pacientes, percebi que criar uma mala direta até poderia melhorar a organização do trabalho dela, mas certamente não resolveria seus maiores problemas, que eram a falta de tempo, recursos humanos e ferramentas tecnológicas melhores para auxiliá-la.</p>

<p align="justify">  Como todo funcionário público no início de carreira, eu estava muito motivado a dar meu melhor. Por isso, propus a ela a criação de um sistema que a ajudaria a localizar rapidamente os dados dos pacientes, agilizar o processo de cadastro e, o principal, gerar automaticamente os documentos necessários. Ver seus olhos brilhando naquele momento em que apresentei essa ideia foi bastante motivador. Foi a primeira vez que eu vendi uma ideia a alguém. Ainda sem saber como fazer ou se seria capaz, sabia que era possível.</p>

<p align="justify">  Voltei para o meu setor e falei para o meu chefe sobre a ideia, mas, como todo chefe de departamento público, ele torceu o nariz e me repreendeu por não ter feito o que havia ordenado. No entanto, eu estava consciente de que eu era o único técnico de TI para atender todos os órgãos da Secretaria Municipal de Saúde naquela época e isso tinha que contar para alguma coisa. Decidi então que construiria este sistema. Voltei para minha mesa e comecei a pesquisar formas de desenvolver uma solução para o problema, foi quando encontrei o PHP e o MySql. Assim começou minha história na área de programação.
</p>

### Tecnologias utilizadas na época

- WAMP5:
  - APACHE 2.0.59;
  - PHP 5.1.6;
  - MYSQL 5.0.24a;
  - PHPMYADMIN 2.8.2.4
- FPDF
- Dreamweaver

# Telas

Tela de Busca:
![image](https://github.com/regis-amaral/__ARCHIVED__TFD-SMS-PMAlegrete/assets/118540708/0ffaa9b8-107a-444f-98e4-e3ead5b9242e)

Tela do Paciente Selecionado:
![image](https://github.com/regis-amaral/__ARCHIVED__TFD-SMS-PMAlegrete/assets/118540708/c37a25df-7664-4c63-8990-f55b00c5b7f2)

Tela do Tratamento:
![image](https://github.com/regis-amaral/__ARCHIVED__TFD-SMS-PMAlegrete/assets/118540708/5ede761f-4cbe-422a-87e8-e60a4503e2c5)

Tela de Gerenciamento Administração:
![image](https://github.com/regis-amaral/__ARCHIVED__TFD-SMS-PMAlegrete/assets/118540708/c5344419-a7c1-47ee-88cd-3e0d61e3254f)



# Relatórios

Relatório Diário de Viagens:
![image](https://github.com/regis-amaral/__ARCHIVED__TFD-SMS-PMAlegrete/assets/118540708/5a1d4630-78c3-4398-9c54-02ec922fc5fd)

Relatório de Pacientes na Fila de Espera:
![image](https://github.com/regis-amaral/__ARCHIVED__TFD-SMS-PMAlegrete/assets/118540708/ec59cbf2-ffe0-47de-ab7c-cb270b36dcec)

Relatório de Pacientes Encaminhados a Tratamento:
![image](https://github.com/regis-amaral/__ARCHIVED__TFD-SMS-PMAlegrete/assets/118540708/0fc17815-86e5-4ccf-a50d-f64a1595c8a3)

Relatório de Pacientes para Controle do Motorista:
![image](https://github.com/regis-amaral/__ARCHIVED__TFD-SMS-PMAlegrete/assets/118540708/48be20ca-f3a4-43cc-b11c-1beb081f9a15)
![image](https://github.com/regis-amaral/__ARCHIVED__TFD-SMS-PMAlegrete/assets/118540708/5abaf310-ea71-476b-ad36-1f3705229a1f)


