pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build') {
            steps {
                // On appelle mvn directement (assurez-vous que maven est installé sur votre VM)
                sh 'mvn clean package -DskipTests'
            }
        }

        stage('Test') {
            steps {
                sh 'mvn test'
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withCredentials([string(credentialsId: 'sonartoken', variable: 'SONAR_TOKEN')]) {
                    // Ici on utilise Docker car le scanner est une image spécifique,
                    // mais comme vous êtes dans une VM, assurez-vous que docker est bien installé dessus.
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
