pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                // Récupération de votre code depuis GitHub
                checkout scm
            }
        }

        stage('Build') {
            steps {
                echo 'Construction du projet avec Maven...'
                // Exécute Maven sur la machine hôte
                sh 'mvn clean package -DskipTests'
            }
        }

        stage('Test') {
            steps {
                echo 'Lancement des tests...'
                sh 'mvn test'
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withCredentials([string(credentialsId: 'sonartoken', variable: 'SONAR_TOKEN')]) {
                    // Analyse avec le conteneur sonar-scanner
                    sh '''
                    docker run --rm \
                    -v "${WORKSPACE}:/usr/src" \
                    sonarsource/sonar-scanner-cli \
                    -Dsonar.projectKey=ecommerce \
                    -Dsonar.sources=/usr/src \
                    -Dsonar.host.url=http://192.168.1.15:9000 \
                    -Dsonar.login=${SONAR_TOKEN}
                    '''
                }
            }
        }
    }
}
