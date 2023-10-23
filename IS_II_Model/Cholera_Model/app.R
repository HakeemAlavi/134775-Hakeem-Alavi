library(shiny)
library(caret)

# Load the logistic regression model
model <- readRDS("cholera_model_two.rds")


# Define the UI
ui <- fluidPage(

  titlePanel("Cholera Classification"),
  sidebarLayout(
    sidebarPanel(
      style = "background-color: #3deb6c;", # Setting the background color of the sidebar
      # Add input fields for the independent variables
      numericInput("age", "Age", value = 25),
      selectInput("vomiting", "Vomiting", choices = c(0, 1), selected = 0),
      selectInput("muscleCramps", "Muscle Cramps", choices = c(0, 1), selected = 0),
      selectInput("rapidHeartRate", "Rapid Heart Rate", choices = c(0, 1), selected = 0),
      selectInput("male", "Male", choices = c(0, 1), selected = 0),
      selectInput("education", "Education Level", choices = c(1, 2, 3, 4), selected = 1),
      selectInput("wateryDiarrhoea", "Watery Diarrhoea", choices = c(0, 1), selected = 0),
      selectInput("dehydration", "Dehydration", choices = c(0, 1), selected = 0),
      br(),
      actionButton("submit", 
                   tags$b("Submit"), 
                   style = "background-color: #ffffff; 
                      color: #3deb6c; 
                      width: 100%; 
                      border-radius: 5px; 
                      padding: 10px; 
                      font-weight: bold;
                      transition: background-color 0.3s, color 0.3s;",
                   class = "submit-button"
      )
      
    ),
    mainPanel(
      # Display the model's prediction
      textOutput("prediction")
    )
  )
)

server <- function(input, output) {
  observeEvent(input$submit, {
    # Display "Testing" on button click
    print("Button clicked")
    
    # Check if the model is loaded
    if (!exists("model")) {
      output$prediction <- renderText({
        "Model not loaded"
      })
      return()
    }
    
    # Check if the inputs are captured
    print("Capturing inputs")
    print(input)
    
    # Extract input values
    age <- as.numeric(input$age)
    vomiting <- as.numeric(input$vomiting)
    muscleCramps <- as.numeric(input$muscleCramps)
    rapidHeartRate <- as.numeric(input$rapidHeartRate)
    male <- as.numeric(input$male)
    education <- as.numeric(input$education)
    wateryDiarrhoea <- as.numeric(input$wateryDiarrhoea)
    dehydration <- as.numeric(input$dehydration)
    
    # Check the classes of the variables after conversion
    print(class(age))
    print(class(vomiting))
    print(class(muscleCramps))
    print(class(rapidHeartRate))
    print(class(male))
    print(class(education))
    print(class(wateryDiarrhoea))
    print(class(dehydration))
    
    # Make the prediction using the loaded model
    tryCatch({
      print("Making prediction")
      prediction <- predict(model, data.frame(age, vomiting, muscleCramps, rapidHeartRate, male, education, wateryDiarrhoea, dehydration))
      
      # Convert the result to "Yes" or "No"
      result <- ifelse(prediction == 1, "Yes", "No")
      
      # Display the prediction
      output$prediction <- renderText({
        paste("Prediction: ", result)
      })
    }, error = function(e) {
      output$prediction <- renderText({
        paste("An error occurred: ", conditionMessage(e), ". Please try again.")
      })
    })
  })
}


# Run the application
shinyApp(ui, server)
