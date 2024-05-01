from django.shortcuts import render
import base64


def index(request):
    return render(request, 'index.html')

def solicitacao(request):    
    return render(request, 'solicitacao.html')
    

def quemsomos(request):
    return render(request, 'quemsomos.html')

