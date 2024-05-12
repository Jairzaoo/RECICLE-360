from django.shortcuts import render
from .models import recolhe  # Ensure it's importing from models, not elsewhere
import base64

def index(request):
    return render(request, 'index.html')

def solicitacao(request):
    return render(request, 'solicitacao.html')

# Renamed view function to avoid conflict with the model
def solicitacoes(request):
    solicitacoes = recolhe.objects.all()
    
    # Pass the records to the template
    context = {
        'solicitacoes': solicitacoes
    }
    return render(request, 'recolhe.html', context)

def quemsomos(request):
    return render(request, 'quemsomos.html')
def encerra(request):
    return render(request, 'encerra.html')
def envia(request):
    if request.method == 'POST':
        # Retrieve form data
        nome = request.POST.get('nome')
        endereco = request.POST.get('endereco')
        telefone = request.POST.get('telefone')
        email = request.POST.get('email')
        data_solicitacao = request.POST.get('data_solicitacao')
        descricao = request.POST.get('descricao')

        # Create a new instance of `recolhe`
        solicitacao = recolhe(
            nome=nome,
            endereco=endereco,
            telefone=telefone,
            email=email,
            data_solicitacao=data_solicitacao,
            descricao=descricao,
            status="Pending"  # Optional default value
        )
        solicitacao.save()  # Save the instance to the database

        # Redirect to a success page or render a success message
        return render(request, 'envia.html')  # Success template
    
    return HttpResponse("Invalid request method", status=405)

def abertas(request):
   # Ensure you're using the correct model
   solicitacoes_abertas = recolhe.objects.filter(status='Aberta')
   context = {'solicitacoes_abertas': solicitacoes_abertas}
   return render(request, 'abertas.html', context)

def atribui(request):
    if request.method == 'POST':
        solicitacao_id = request.POST.get('solicitacao_id')
        nome = request.POST.get('nome')
        contato = request.POST.get('contato')

        # Create a new record
        servico = ServicosAbertos(
            solicitacao_id=solicitacao_id,
            nome=nome,
            contato=contato,
        )
        servico.save()  # Save the record to the database

        # Redirect to a success page or render a success message
        return render(request, 'atribui.html')  # Success template

    return HttpResponse("Invalid request method", status=405)