# booking-system-v2
booking-system-v2

## Task outcome
1. create Docker image using the Dockerfile
2. tag the docker image as <your image registry>:kv1
3. push the <your image registry>:kv1  to Docker Regisrty (docker hub)
4. Create Kubernetes cluster on you laptop by using (minikube / k3d / kind /Docker Desktop )
5. Deploy Web and Database on cluster (Modify the image on the deployment files)
6. Expose the service with LoadBalancer
7. Inject the SQL file data on DB.
8. Ensure Application fuctionality.

booking-system-v2
booking-system-v2

Task outcome
create Docker image using the Dockerfile
tag the docker image as :kv1
push the :kv1 to Docker Regisrty (docker hub)
Create Kubernetes cluster on you laptop by using (minikube / k3d / kind /Docker Desktop )
Deploy Web and Database on cluster (Modify the image on the deployment files)
Expose the service with LoadBalancer
Inject the SQL file data on DB.
Ensure Application fuctionality.
step 1 docker build -t bookingsystem:kv1

step 2 docker tag bookingsystem:kv1 palaniyappankannan/bookingsystem:kv1

step 3
docker push bookingsystem:kv1 palaniyappankannan/bookingsystem:kv1

step 4: 

  install docker desktop enable kubernetes docker desktop -> settings -> kubernetes -> enable kubernetes

  kubectl get node

step 5: 

kubectl create -f booking-system-web-deployment.yaml

kubectl create -f booking-system-db-deployment.yaml

step 6 

kubectl port-forward svc/booking-system-service 8080:80

kubectl expose svc booking-system-service --name booking-system-service-lb --port=80 --target-port=80 --type=LoadBalancer 

step 7: 

kubectl cp booking_system.sql booking-system-db-76d94778b5-txz7h:/tmp/ 

kubectl exec -it pod/booking-system-db-76d94778b5-txz7h -- bash 

mysql -u root -p booking_system < booking_system.sql
