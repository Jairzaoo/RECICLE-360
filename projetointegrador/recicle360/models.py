
from django.db import models


class recolhe(models.Model):
    nome = models.CharField(max_length=255)
    endereco = models.CharField(max_length=255)  # Add endereco field
    telefone = models.CharField(max_length=15)   # Add telefone field
    email = models.EmailField()                  # Add email field
    data_solicitacao = models.DateField()        # Add data_solicitacao field
    descricao = models.TextField()               # Add descricao field
    status = models.CharField(max_length=255, default="Pending")


    def __str__(self):
        return self.nome

class ServicosAbertos(models.Model):
    solicitacao_id = models.IntegerField()
    nome = models.CharField(max_length=255)
    contato = models.CharField(max_length=255)

    def __str__(self):
        return self.nome