###> builder ###
#FROM node:10-alpine as builder
#COPY /src/front/package.json /src/front/package-lock.json ./
#
# Storing node modules on a separate layer will prevent unnecessary npm installs at each build
#RUN npm i && mkdir /ng-app && cp -R ./node_modules ./ng-app
#WORKDIR /ng-app
#COPY /src/front .
#
# Build the angular app in production mode and store the artifacts in dist folder
#RUN $(npm bin)/ng build ---prod
###< end builder ###

####> nginx image ###

FROM nginx:1.15-alpine as base


WORKDIR /var/www/gocook

# Set labels
ARG version
LABEL com.gocook.version $version


## From builder stage copy over the artifacts in dist folder to default nginx public folder
#COPY --from=builder /ng-app/dist /var/www/dist

##< nginx image ###









####> dev image only ###
#FROM base as dev
#
### From builder stage copy over the artifacts in dist folder to default nginx public folder
#COPY --from=builder /ng-app/dist /var/www/dist
#
####< dev image only ###
#
####> prod image only ###
#FROM base as prod
#
### From builder stage copy over the artifacts in dist folder to default nginx public folder
#COPY --from=builder /ng-app/dist /var/www/dist

###< prod image only ###
