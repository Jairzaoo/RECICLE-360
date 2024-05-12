
from django.db import models


class recolhe(models.Model):
    nome = models.CharField(max_length=255)
    endereco = models.CharField(max_length=255)
    telefone = models.CharField(max_length=15)
    email = models.EmailField()
    data_solicitacao = models.DateField()
    descricao = models.TextField()
    status = models.CharField(max_length=255)

    def __str__(self):
        return self.nome

class ServicosAbertos(models.Model):
    solicitacao_id = models.IntegerField()
    nome = models.CharField(max_length=255)
    contato = models.CharField(max_length=255)

    def __str__(self):
        return self.nome