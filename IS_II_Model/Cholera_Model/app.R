library(shiny)
library(caret)

# Load the logistic regression model
model <- readRDS("cholera_model_two.rds")

# Define the UI
ui <- fluidPage(
  br(),
  sidebarLayout(
    sidebarPanel(
      style = "background-color: #3deb6c; padding: 20px; border-radius: 5px; box-shadow: 2px 2px 5px #888888;",
      # Add input fields for the independent variables
      
      br(),
      tags$p(style = "font-weight: bold;", "Disclaimer"),
      tags$p("The AI model's diagnosis has an accuracy of 67%."),
      tags$p("Please fill in the form to receive a cholera classification based on your respective symptoms."),
      br(),
      numericInput("age", "Age", value = 25, min = 0, max = 120),
      selectInput("male", "Gender", choices = c("Female", "Male"), selected = "Male"),
      selectInput("vomiting", "Vomiting", choices = c("No", "Yes"), selected = "No"),
      selectInput("muscleCramps", "Muscle Cramps", choices = c("No", "Yes"), selected = "No"),
      selectInput("rapidHeartRate", "Rapid Heart Rate", choices = c("No", "Yes"), selected = "No"),
      selectInput("wateryDiarrhoea", "Watery Diarrhoea", choices = c("No", "Yes"), selected = "No"),
      selectInput("dehydration", "Dehydration", choices = c("No", "Yes"), selected = "No"),
      selectInput("education", "Education Level", choices = c("Weak", "Average", "Good", "Exceptional"), selected = "Primary"),
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
      div(style = "padding-left: 150px; padding-top: 10px; font-weight: bold;",
          h3("Cholera Diagnosis", style = "color: #3deb6c;"),
          textOutput("prediction")
      )
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
    vomiting <- ifelse(input$vomiting == "Yes", 1, 0)
    muscleCramps <- ifelse(input$muscleCramps == "Yes", 1, 0)
    rapidHeartRate <- ifelse(input$rapidHeartRate == "Yes", 1, 0)
    male <- ifelse(input$male == "Male", 1, 0)
    education <- match(input$education, c("Weak", "Average", "Good", "Exceptional"))
    wateryDiarrhoea <- ifelse(input$wateryDiarrhoea == "Yes", 1, 0)
    dehydration <- ifelse(input$dehydration == "Yes", 1, 0)
    
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
        paste("Result: ", result)
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
         