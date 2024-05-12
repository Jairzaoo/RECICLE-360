from django.shortcuts import render, redirect
from django.http import HttpResponse
from .models import recolhe, ServicosAbertos, Solicitacao  # Import models module

def index(request):
    return render(request, 'index.html')

def solicitacao(request):
    if request.method == 'POST':
        # Retrieve form data
        nome = request.POST.get('nome')
        endereco = request.POST.get('endereco')
        telefone = request.POST.get('telefone')
        email = request.POST.get('email')
        data_solicitacao = request.POST.get('data_solicitacao')
        descricao = request.POST.get('descricao')

        # Create a new instance of `Solicitacao`
        solicitacao = Solicitacao(
            nome=nome,
            endereco=endereco,
            telefone=telefone,
            email=email,
            data_solicitacao=data_solicitacao,
            descricao=descricao,
            status="Aberta"  # Optional default value
        )
        solicitacao.save()  # Save the instance to the database

        # Redirect to a success page or render a success message
        return render(request, 'envia.html')  # Success template
    
    return render(request, 'solicitacao.html')

def solicitacoes(request):
    solicitacoes = recolhe.objects.all()
    context = {
        'solicitacoes': solicitacoes
    }
    return render(request, 'recolhe.html', context)

def quemsomos(request):
    return render(request, 'quemsomos.html')

def envia(request):
    return HttpResponse("Invalid request method", status=405)

def abertas(request):
    solicitacoes_abertas = ServicosAbertos.objects.all()
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

def encerra(request):
    if request.method == 'POST':
        # Retrieve the ID of the service to be closed from the form data
        solicitacao_id = request.POST.get('solicitacao_id')

        # Update the service to mark it as closed
        try:
            service = ServicosAbertos.objects.get(solicitacao_id=solicitacao_id)
            service.encerrado = True
            service.save()
            return redirect('abertas')  # Redirect to the list of open services
        except ServicosAbertos.DoesNotExist:
            return HttpResponse("Service not found", status=404)

    return render(request, 'encerra.html')
