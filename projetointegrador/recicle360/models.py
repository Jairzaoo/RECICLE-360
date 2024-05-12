from django.db import models

class Solicitacao(models.Model):
    nome = models.CharField(max_length=75)
    endereco = models.CharField(max_length=100)
    telefone = models.CharField(max_length=10)
    email = models.EmailField()
    data_solicitacao = models.DateField()
    descricao = models.CharField(max_length=255)
    status = models.CharField(max_length=50, default='Aberta')

    def __str__(self):
        return self.nome

class ServicosAbertos(models.Model):
    solicitacao = models.ForeignKey(Solicitacao, on_delete=models.CASCADE)
    nome = models.CharField(max_length=50)
    contato = models.CharField(max_length=12)
    status_execucao = models.CharField(max_length=50, default='Em Andamento')
    encerrado = models.BooleanField(default=False)

    def __str__(self):
        return self.nome
