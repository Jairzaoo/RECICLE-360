
from django.db import models


class recolhe(models.Model):
    nome = models.CharField(max_length=255)
    solicitacao_id = models.IntegerField()  # Assuming this is the ID of the request
    contato = models.CharField(max_length=255)
    status_execucao = models.CharField(max_length=255)  # Assuming this is the status field
    encerrado = models.BooleanField(default=False)
    
    def __str__(self):
        return self.nome

class ServicosAbertos(models.Model):
    solicitacao_id = models.IntegerField()
    nome = models.CharField(max_length=255)
    contato = models.CharField(max_length=255)

    def __str__(self):
        return self.nome